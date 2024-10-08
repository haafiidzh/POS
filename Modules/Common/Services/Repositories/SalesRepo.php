<?php

namespace Modules\Common\Services\Repositories;

use Modules\Common\Models\Transaction;

class SalesRepo
{

    public function filters(object $request, $total = 10, $paginated = true)
    {
        $user = auth()->user();
        $transactions = Transaction::query()->with('partner:id,name');

        if ($user->hasRole(['Mitra'], 'web')) {
            $transactions->where('partner_id', $user->partner->id);
        }

        if (isset($request->search)) {
            if ($request->search) {
                $transactions->search($request);
            }
        }

        if (isset($request->date_start) && isset($request->date_end)) {
            $transactions->whereBetween('created_at', [$request->date_start, $request->date_end]);
        }


        if (!$paginated) {
            return $transactions->orderBy('created_at', 'desc')->get();
        }

        return $transactions->sort($request)->orderBy('created_at', 'desc')->paginate($total);
    }
}
