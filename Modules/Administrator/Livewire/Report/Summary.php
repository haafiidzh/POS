<?php

namespace Modules\Administrator\Livewire\Report;

use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\GuestMessage;
use Modules\Common\Models\Product;
use Modules\Common\Models\Transaction;
use Modules\Common\Traits\Utils\FlashMessage;

class Summary extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define array props
     * @var array
     */
    public $dates = [
        'start' => '',
        'end' => '',
    ];

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
    }

    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

    /**
     * Count order by status
     * @return Order
     */
    public function countTransaction()
    {
        return Transaction::where(function ($query) {
            return $query->whereDate('transaction_date', '>=', $this->dates['start'])
                ->whereDate('transaction_date', '<=', $this->dates['end']);
        })->count();
    }

    public function sumTransaction()
    {
        return Transaction::whereDate('transaction_date', '>=', $this->dates['start'])
            ->whereDate('transaction_date', '<=', $this->dates['end'])
            ->sum('total_amount');
    }

    public function countProduct()
    {
        return Product::all()->count();
    }

    public function render()
    {
        return view('administrator::livewire.report.summary', [
            'count' => [
                'transaction' => self::countTransaction(),
                'product' => self::countProduct(),
                'total' => self::sumTransaction(),
            ],
        ]);
    }
}
