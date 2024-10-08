<?php

namespace Modules\Administrator\Livewire\Visitor;

use Modules\Common\Models\Visitor;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Pie extends Component
{
    public array $labels = ['Harian', 'Mingguan', 'Bulanan', 'Tahunan'];

    public array $data = [];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount()
    {
        $this->data = $this->getData();
        $this->dispatch('load-pie-chart', [
            'data' => $this->data,
        ]);
    }

    /**
     * Get chart data
     * @return array
     */
    public function getData(): array
    {
        $visitor_today = Visitor::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $visitor_weekly = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $visitor_monthly = Visitor::whereMonth('created_at', Carbon::now()->month)->count();
        $visitor_yearly = Visitor::whereYear('created_at', Carbon::now()->year)->count();

        return [
            'labels' => $this->labels,
            'datasets' => [
                [
                    'data' => [
                        $visitor_today,
                        $visitor_weekly,
                        $visitor_monthly,
                        $visitor_yearly,
                    ],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.5)', // Semi-transparent red
                        'rgba(54, 162, 235, 0.5)', // Semi-transparent blue
                        'rgba(255, 206, 86, 0.5)', // Semi-transparent yellow
                        'rgba(75, 192, 192, 0.5)', // Semi-transparent green
                    ],
                ],
            ],
        ];
    }

    public function render()
    {
        return view('administrator::livewire.visitor.pie');
    }
}
