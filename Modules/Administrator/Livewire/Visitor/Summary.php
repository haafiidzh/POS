<?php

namespace Modules\Administrator\Livewire\Visitor;

use Modules\Common\Models\Visitor;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Summary extends Component
{
    public $visitor_today, $visitor_weekly, $visitor_monthly, $visitor_yearly;

    public function mount()
    {
        $this->visitor_today = Visitor::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $this->visitor_weekly = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $this->visitor_monthly = Visitor::whereMonth('created_at', Carbon::now()->month)->count();
        $this->visitor_yearly = Visitor::whereYear('created_at', Carbon::now()->year)->count();
    }

    public function render()
    {
        return view('administrator::livewire.visitor.summary');
    }
}
