<?php

namespace Modules\Administrator\Livewire\Coupon;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Contracts\WithModal;
use Modules\ECommerce\Models\Coupon;
use Modules\Common\Utils\CustomTable;
use Modules\Common\Contracts\WithTable;
use Modules\Common\Contracts\WithRemoveModal;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\ECommerce\Services\Repositories\CouponRepo;

class Table extends Component
{
    use WithPagination, WithModal, WithTable, WithRemoveModal, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $sort = 'created_at';
    public ?string $order = 'desc';
    public ?string $search = '';
    public ?string $destroyId = '';

    /**
     * Define int props
     * @var int
     */
    public ?int $per_page = 10;

    /**
     * Define query string used
     * in this component
     * @var array
     */
    protected $queryString = [
        'search',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::TABLE_SORT_ORDER,
        self::CHANGE_PERPAGE,
        self::DESTROY,
        self::FLASH => '$refresh',
    ];

    /**
     * Define props value before component rendered
     *
     * @return void
     */
    public function mount()
    {
        //
    }

    /**
     * Define table headers
     * @var array
     */
    public function headers()
    {
        return [
            [
                'label' => 'Kupon',
                'name' => 'code',
                'sortable' => true,
            ],
            [
                'label' => 'Diskon',
                'name' => 'amount',
                'sortable' => false,
            ],
            [
                'label' => 'Tgl. Berakhir',
                'name' => 'expiry_date',
                'sortable' => true,
            ],
            [
                'label' => 'Kuota',
                'name' => 'quota',
                'sortable' => true,
            ],
            [
                'label' => 'Aktif?',
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
     * Livewire hooks, when search props has been updated
     * This method will be running
     *
     * @param  string $value
     * @return void
     */
    public function updated($property, $value)
    {
        if ($property !== 'destroyId') {
            $this->resetPage();
        }

        if (!$value || $value == null) {
            $this->reset($property);
        }
    }

    /**
     * Get all $VARIABLE$ data from resource
     *
     * @return void
     */
    public function getAll()
    {
        return (new CouponRepo)->filters((object) [
            'search' => $this->search,
            'sort' => $this->sort,
            'order' => $this->order,
        ]);
    }

    /**
     * Edit coupon
     * Dispatch to edit coupon class
     *
     * @param  int|null $id
     * @return void
     */
    public function edit($id)
    {
        return $this->dispatch('editCoupon', $id)->to(Edit::class);
    }

    /**
     * Created callback
     * Listen from another component event
     *
     * @return void
     */
    public function created()
    {
        $this->resetPage();
    }

    /**
     * Destroy coupon from resource
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $coupon = Coupon::find($this->destroyId);
            $coupon->delete();

            $this->dispatch('close-modal');

            return session()->flash('success', 'Coupon berhasil dihapus.');
        } catch (Exception $exception) {
            return session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        $table = new CustomTable;
        $table->columns(self::headers());

        return view('administrator::livewire.coupon.table', [
            // 'datas' => $this->getAll(),
            'table' => $table,
        ]);
    }
}
