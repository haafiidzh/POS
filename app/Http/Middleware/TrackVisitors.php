<?php

namespace App\Http\Middleware;

use Modules\Common\Models\Visitor;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        $currentUrl = $request->fullUrl();

        if (!$this->isRecentVisitor($ipAddress, $currentUrl)) {
            $this->trackVisitor($ipAddress, $userAgent, $currentUrl);
            $this->updateVisitorCounts();
        }

        return $next($request);
    }

    private function isRecentVisitor($ipAddress, $currentUrl)
    {
        return Visitor::where('ip_address', $ipAddress)
            ->where('url', $currentUrl)
            ->where('last_visit', '>', Carbon::now()->subSeconds(120))
            ->exists();
    }

    private function trackVisitor($ipAddress, $userAgent, $currentUrl)
    {
        try {
            $this->createVisitor($ipAddress, $userAgent, $currentUrl);
        } catch (Exception $exception) {
            // Retry logic in case of failure
            try {
                $this->createVisitor($ipAddress, $userAgent, $currentUrl);
            } catch (Exception $exception) {
                // Log the exception if needed
            }
        }
    }

    private function createVisitor($ipAddress, $userAgent, $currentUrl)
    {
        DB::beginTransaction();
        try {
            $visitor = new Visitor();
            $visitor->id = substr(Str::random(32), rand(0, 24), 8);
            $visitor->ip_address = $ipAddress;
            $visitor->user_agent = $userAgent;
            $visitor->url = $currentUrl;
            $visitor->last_visit = Carbon::now();
            $visitor->save();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    private function updateVisitorCounts()
    {
        $visitor_yearly = Visitor::whereYear('created_at', Carbon::now()->year)->count();
        $visitor_monthly = Visitor::whereMonth('created_at', Carbon::now()->month)->count();
        $visitor_weekly = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $visitor_today = Visitor::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();

        Cache::forget('visitor_count');
        Cache::forever('visitor_count', [
            'visitor_yearly' => $visitor_yearly,
            'visitor_monthly' => $visitor_monthly,
            'visitor_weekly' => $visitor_weekly,
            'visitor_today' => $visitor_today,
        ]);
    }
}
