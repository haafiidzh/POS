<?php

namespace Modules\Administrator\Livewire\Order;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Contracts\WithTable;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Common\Utils\CustomTable;
use Modules\ECommerce\Models\Order;
use Modules\ECommerce\Services\Repositories\OrderRepo;

class Table extends Component
{
    use WithPagination, WithTable, FlashMessage, WithModal, WithThirdParty;

    public $show_order = null;

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
        'search', 'sort', 'order', 'status', 'dates',
    ];
    public array $dates = [
        'start' => '',
        'end' => '',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listener = [
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

    /**
     * Define table headers
     * @var array
     */
    public function headers()
    {
        return [
            [
                'label' => 'Pelanggan',
                'name' => null,
                'sortable' => false,
            ],
            [
                'label' => 'Kode Pesanan',
                'name' => 'order_code',
                'sortable' => false,
            ],
            [
                'label' => 'Status',
                'name' => null,
                'sortable' => false,
            ],
            [
                'label' => 'Link Tagihan',
                'name' => null,
                'sortable' => false,
            ],
            [
                'label' => 'qty',
                'name' => 'details_counts',
                'sortable' => false,
            ],
            [
                'label' => 'Nominal',
                'name' => null,
                'sortable' => false,
            ],
            [
                'label' => 'Aksi',
                'name' => null,
                'sortable' => false,
            ],
        ];
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
        $this->dates = $value;
    }

    /**
     * Livewire hooks, when search props has been updated
     * This method will be running
     *
     * @param  string $value
     * @return void
     */
    public function updatedSearch($value)
    {
        $this->resetPage();
        $this->search = $value;
    }

    /**
     * Updated callback
     * Listen from another component event
     *
     * @return void
     */
    public function updated($component, $value)
    {
        if ($component !== 'destroyId') {
            $this->resetPage();
        }

        if (!$value || $value == null) {
            $this->reset($component);
        }
        // $this->resetPage();
    }

    /**
     * Get all $VARIABLE$ data from resource
     *
     * @return void
     */
    public function getAll()
    {
        return (new OrderRepo)->filters((object) [
            'search' => $this->search,
            'sort' => 'created_at',
            'order' => 'desc',
            'dates' => $this->dates,
            'order_status' => $this->status,
        ], $this->per_page);
    }

    /**
     * Destroy order from resource
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $order = Order::find($this->destroyId);
            $order->delete();

            $this->dispatch('close-modal');

            return session()->flash('success', 'Order berhasil dihapus.');
        } catch (Exception $exception) {
            return session()->flash('error', $exception->getMessage());
        }
    }

    /**
     * handle show order detail
     *
     * @param  mixed $order_code
     * @return void
     */
    public function showOrder($order_code)
    {
        return $this->dispatch('showOrder', $order_code)->to(Show::class);
    }

    /**
     * Listing of order status
     * @return array
     */
    public function orderStatuses()
    {
        return [
            [
                'value' => 'all',
                'label' => 'Semua',
            ],
            [
                'value' => 'pending',
                'label' => 'Tertunda',
            ],
            [
                'value' => 'complete',
                'label' => 'Selesai',
            ],
            [
                'value' => 'expired',
                'label' => 'Kadaluwarsa',
            ],
        ];
    }

    /**
     * rendering view
     *
     * @return void
     */
    public function render()
    {
        $table = new CustomTable;
        $table->columns(self::headers());

        return view('administrator::livewire.order.table', [
            // 'datas' => $this->getAll(),
            'table' => $table,
            'order_statuses' => self::orderStatuses(),
        ]);
    }
}
