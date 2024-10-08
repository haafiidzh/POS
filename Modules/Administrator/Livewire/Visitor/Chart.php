<?php

namespace Modules\Administrator\Livewire\Visitor;

use Modules\Common\Models\Visitor;
use Livewire\Component;


class Chart extends Component
{

        /**
     * Livewire component event listener for DaterangePicker Component
     * @uses Modules\Core\Livewire\Utils\DaterangePicker::class
     * @var  UPDATED_DATERANGEPICKER
     */
    const UPDATED_DATERANGEPICKER = 'updatedDaterangePicker';



    /**
     * Define int props
     * @var int
     */
    public int $total_visitor = 0;

    /**
     * Define array props
     * @var array
     */
    public array $dates = [
        'start' => '',
        'end' => '',
    ];
    public array $labels = [];
    public array $data = [];
    

    /**
     * Define event listeners
     * @var array
     */
    public $listeners = [
        self::UPDATED_DATERANGEPICKER,
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(array $dates)
    {
        $this->dates = $dates;
        $this->data = self::getData();
    }

    /**
     * Hooks for date range picker property
     * Doing date range picker validation after
     * Date property has been updated
     *
     * @param  array $value
     * @return void
     */
    public function updatedDaterangePicker(array $value)
    {
        $data = self::getData();
        $this->dates = $value;
        $this->data = $data;
        $this->dispatch('update-visitor-chart', [
            'labels' => $this->labels,
            'data' => $data,
        ]);
    }


    public function countVisitor($dates)
    {
        return Visitor::query()
            ->when(!empty($dates), function ($query) use ($dates) {
                $query->whereDate('created_at', '>=', $dates['start'])
                    ->whereDate('created_at', '<=', $dates['end']);
            })->count();
    }

    /**
     * Get chart data or data
     * @return array
     */
    public function getData()
    {
        $dates = collect(chartMetrics($this->dates));
        $data = $dates->map(function ($date) {
            return self::countVisitor($date);
        });

        $this->total_visitor = $data->sum();

        return [
            [
                'label' => 'Jumlah Pengunjung',
                'data' => $data->toArray(),
            ],
        ];
    }

    public function render()
    {
        return view('administrator::livewire.visitor.chart');
    }
}
