<?php

namespace Modules\Administrator\Livewire\Sales;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Contracts\WithTable;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Traits\Utils\FlashMessage;

class Overview extends Component
{
    use WithPagination, WithTable, FlashMessage, WithModal, WithThirdParty;

    public $show_transaction = null;

    /**
     * Defines the properties used
     * in this component
     *
     * @var string
     */
    public ?string $sort = 'created_at';
    public ?string $order = 'desc';
    public ?string $search = '';
    public ?string $destroyId = '';
    public ?string $status = 'all';
    public ?string $transaction_type = 'all';
    public ?string $payment_type = 'all';

    /**
     * Defines the properties used
     * in this component
     *
     * @var int
     */
    public ?int $per_page = 10;

    /**
     * Define query string used
     * in this component
     *
     * @var array
     */
    protected $queryString = [
        'search',
        'sort',
        'transaction',
        'status',
        'dates',
    ];
    public array $dates = [
        'start' => '',
        'end' => '',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::TABLE_SORT_ORDER,
        self::CHANGE_PERPAGE,
        self::UPDATED_DATERANGEPICKER,
        self::FLASH => '$refresh',
    ];

    /**
     * Define props value before component rendered
     *
     * @return void
     */
    public function mount()
    {
        $this->dates['start'] = now()->startOfYear()->toDateString();
        $this->dates['end'] = now()->endOfYear()->toDateString();
    }

    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

    public function render()
    {
        return view('administrator::livewire.sales.overview');
    }
}