<?php

namespace Modules\Administrator\Livewire\Report;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Contracts\WithTable;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\Partner;
use Modules\Common\Services\Repositories\ReportRepo;
use Modules\Common\Services\Repositories\SalesRepo;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Common\Utils\CustomTable;

class Overview extends Component
{
    use WithPagination, WithTable, FlashMessage, WithModal, WithThirdParty;

    public ?string $sort = 'date';
    public ?string $order = 'desc';
    public ?string $search = '';
    
    public ?int $per_page = 10;

    public $selectedPartner = null;  // Menambahkan properti untuk menyimpan ID Mitra yang dipilih
    public $partners = [];   

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

        $this->partners = Partner::all(['id', 'name']);
    }

    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

    public function updatePartner($value)
    {
        $this->selectedPartner = $value;
    }

    public function headers()
    {
        return [
            [
                'label' => 'Tanggal Transaksi',
                'name' => 'date',
                'sortable' => true,
            ],
            [
                'label' => 'Nama Mitra',
                'name' => 'kontol',
                'sortable' => false,
            ],
            [
                'label' => 'Cash',
                'name' => 'null',
                'sortable' => false,
            ],
            [
                'label' => 'QRIS',
                'name' => 'null',
                'sortable' => false,
            ],
            [
                'label' => 'Total Penjualan',
                'name' => 'total_sales',
                'sortable' => false,
            ],
            [
                'label' => 'Aksi',
                'name' => null,
                'sortable' => false,
            ],
        ];
    }

    public function sort($column)
    {
        $this->resetPage();
        $this->sort = $column;
    }

    public function getAll()
    {
        return (new ReportRepo())->dailyReport((object) [
            'sort' => $this->sort,
            'search' => $this->search,
            'order' => $this->order,
            'date_start' => $this->dates['start'], // Tambahkan date_start
            'date_end' => $this->dates['end'], 
            'partner_id' => $this->selectedPartner,
        ], $this->per_page);   
    }

    public function render()
    {
        $table = new CustomTable;
        $table->columns(self::headers());

        return view('administrator::livewire.report.overview', [
            'datas' => self::getAll(),
            'table' => $table
        ]);
    }
}