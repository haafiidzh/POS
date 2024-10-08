<?php

namespace Modules\Administrator\Livewire\Sales;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithTable;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Utils\CustomTable;
use Modules\Common\Services\Repositories\SalesRepo;

class Table extends Component
{
    use WithTable, WithThirdParty, WithPagination, FlashMessage;

    
    /**
     * Defines string props
     * @var string
     */
    public string $sort = 'created_at';
    public string $order = 'desc';
    public string $search = '';
    public string $destroyId = '';


    public int $per_page = 12;

    /**
     * Define array props
     * @var array
     */
    public $dates = [
        'start' => '',
        'end' => '',
    ];

    protected array $queryString = [
        'search',
    ];

    /**
     * Define event listeners
     * @var array
     */
    public $listeners = [
        self::UPDATED_DATERANGEPICKER,
        self::TABLE_SORT_ORDER,
        self::CHANGE_PERPAGE,
    ];

    public function mount(array $dates)
    {
        $this->dates = $dates;
    }

    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

   
    public function sort($column)
    {
        $this->resetPage();
        $this->sort = $column;
    }

    public function headers()
    {
        $headers = [
            [
                'label' => 'ID Transaksi',
                'name' => 'id',
                'sortable' => true,
            ],
            [
                'label' => 'Tanggal Transaksi',
                'name' => 'transaction_date',
                'sortable' => true,
            ],
            [
                'label' => 'Metode Pembayaran',
                'name' => 'payment_method',
                'sortable' => false,
            ],
            [
                'label' => 'Total',
                'name' => 'total_amount',
                'sortable' => false,
            ],
            [
                'label' => 'Aksi',
                'name' => null,
                'sortable' => false,
            ],
        ];
    
        // Cek kondisi apakah kolom 'Nama Mitra' ingin ditampilkan
        if (auth()->user()->hasRole(['Developer', 'Admin'], 'web')) {
            array_splice($headers, 1, 0, 
            [
                [
                'label' => 'Nama Mitra',
                'name' => 'partner_id',
                'sortable' => false,
                ]
            ]);
        }
    
        return $headers;
    }

    
    public function getAll()
    {
        return (new SalesRepo())->filters((object) [
            'sort' => $this->sort,
            'search' => $this->search,
            'order' => $this->order,
            'date_start' => $this->dates['start'], // Tambahkan date_start
            'date_end' => $this->dates['end'], 
        ], $this->per_page);
    }


    public function render()
    {
        $table = new CustomTable;
        $table->columns(self::headers());
        return view('administrator::livewire.sales.table', [
            'datas' => self::getAll(),
            'table' => $table
        ]);
    }
}
