<?php

namespace Modules\Administrator\Livewire\Report;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Contracts\WithTable;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Common\Utils\CustomTable;
use Modules\ECommerce\Enums\PaymentMethodType;
use Modules\ECommerce\Enums\TransactionType;
use Modules\ECommerce\Services\Repositories\TransactionRepo;

class Transaction extends Component
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
                'label' => 'Tipe Trx',
                'name' => 'type',
                'sortable' => false,
            ],
            [
                'label' => 'Status',
                'name' => null,
                'sortable' => false,
            ],
            [
                'label' => 'Tgl. Trx',
                'name' => null,
                'sortable' => false,
            ],
            [
                'label' => 'Pembayaran',
                'name' => 'type',
                'sortable' => false,
            ],
            [
                'label' => 'Debet',
                'name' => 'details_counts',
                'sortable' => false,
            ],
            [
                'label' => 'Kredit',
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
        return (new TransactionRepo)->filters((object) [
            'search' => $this->search,
            'sort' => 'created_at',
            'order' => 'desc',
            'dates' => $this->dates,
            'payment_method_type' => $this->payment_type,
            'type' => $this->transaction_type,
            'status' => $this->status,
        ], $this->per_page);
    }

    /**
     * Get all $VARIABLE$ data from resource
     *
     * @return void
     */
    public function countDebetCredit()
    {
        return (new TransactionRepo)->getDebetCredit((object) [
            'search' => $this->search,
            'sort' => 'created_at',
            'order' => 'desc',
            'dates' => $this->dates,
            'payment_method_type' => $this->payment_type,
            'type' => $this->transaction_type,
            'status' => $this->status,
        ]);
    }

    /**
     * Destroy transaction from resource
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $transaction = Transaction::find($this->destroyId);
            $transaction->delete();

            $this->dispatch('close-modal');

            return session()->flash('success', 'Transaction berhasil dihapus.');
        } catch (Exception $exception) {
            return session()->flash('error', $exception->getMessage());
        }
    }

    /**
     * handle show transaction detail
     *
     * @param  mixed $transaction_code
     * @return void
     */
    public function showTransaction($transaction_code)
    {
        // return $this->dispatch('showTransaction', $transaction_code)->to(Show::class);
    }

    /**
     * Listing of transaction status
     * @return array
     */
    public function transactionStatuses()
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

    public function render()
    {
        $table = new CustomTable;
        $table->columns(self::headers());

        return view('administrator::livewire.report.transaction', [
            'datas' => self::getAll(),
            'count' => self::countDebetCredit(),
            'table' => $table,
            'transaction_statuses' => self::transactionStatuses(),
            'types' => TransactionType::cases(),
            'payment_types' => PaymentMethodType::cases(),
        ]);
    }
}