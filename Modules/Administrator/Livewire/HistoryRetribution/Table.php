<?php

namespace Modules\Administrator\Livewire\HistoryRetribution;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Constants\Utilities;
use Modules\Common\Contracts\WithRemoveModal;
use Modules\Common\Models\Category;
use Modules\Common\Models\Partner;
use Modules\Common\Services\ImageService;
use Modules\Common\Services\Repositories\HistoryRepo;
use Modules\Common\Services\Repositories\PartnerRepo;
use Modules\Common\Traits\Utils\FlashMessage;
use stdClass;
use Modules\Core\Models\User;

class Table extends Component
{
    use WithPagination, WithRemoveModal, FlashMessage;

    /**
     * Defines string props
     * @var string
     */
    public string $type = '';
    public string $status = '';
    public string $sort = 'created_at';
    public string $order = 'desc';
    public string $search = '';
    public string $destroyId = '';

    public string $partner = '';




    /**
     * Defines int props
     * @var int
     */
    public int $per_page = 12;

    /**
     * Defines array property
     * @var array
     */
    protected array $queryString = [
        'search',
    ];

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::CANCEL,
        self::DESTROY,
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount()
    {
        //
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

    
    public function getPartner()
    {
        return Partner::all();
    }

    /**
     * To handle sort dropdown
     * Update filters property value
     *
     * @param  string $value
     * @return void
     */
    public function sort($column)
    {
        $this->resetPage();
        $this->sort = $column;
    }

    /**
     * To handle order dropdown
     * Update filters property value
     *
     * @param  string $value
     * @return void
     */
    public function order($order)
    {
        $this->resetPage();
        $orders = ['asc', 'desc'];
        if (in_array($order, $orders)) {
            $this->order = $order;
        } else {
            $this->order = null;
        }
    }

    /**
     * Get all post categories
     * @return void
     */

    /**
     * Get all posts from database
     * @return void
     */
    public function getAllHistory()
    {
        return (new HistoryRepo())->filters((object) [
            'status' => $this->status,
            'sort' => $this->sort,
            'order' => $this->order,
            'search' => $this->search,
            'partner' => $this->partner,
            'user_id' => $this->user_id,

        ], $this->per_page);
    }

    /**
     * Change post status bocome archive or publish
     *
     * @param  string $id
     * @return void
     */
    public function toggleStatus($id, $status)
    {
        try {
            $partner = Partner::find($id);

            if (!$partner) {
                throw new Exception('Partner tidak ditemukan, status gagal diubah.');
            }

            // Update status sesuai pilihan yang diinginkan
            $partner->update([
                'status' => $status,
            ]);

            $partner = Partner::find($id);

            if (!$partner) {
                throw new Exception('Partner tidak ditemukan, status gagal diubah.');
            }

            // Update status sesuai pilihan yang diinginkan
            $partner->update([
                'status' => $status,
            ]);

            // Menentukan pesan berdasarkan status menggunakan switch
            switch ($status) {
                case 'hold':
                    $text = 'Partner berhasil diubah menjadi Hold.';
                    break;
                case 'active':
                    $text = 'Partner berhasil diubah menjadi Active.';
                    break;
                case 'pending':
                    $text = 'Partner berhasil diubah menjadi Pending.';
                    break;
                default:
                    $text = 'Status tidak valid.';
                    break;
            }

            return $this->dispatchSuccess($text);
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Destroy post from database
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $post = Partner::where('id', $this->destroyId)->first();

            if (!$post) {
                throw new Exception('Partner tidak ditemukan, Partner gagal dihapus.');
            }

            // Force delete
            $post->forceDelete();
            $this->reset('destroyId');

            return $this->dispatchSuccess('Partner berhasil dihapus.', true);
        } catch (Exception $exception) {
            $this->reset('destroyId');
            return $this->dispatchError($exception->getMessage(), true);
        }
    }

    public function render()
    {
        return view('administrator::livewire.history-retribution.table', [
            'datas' => self::getAllHistory(),
            'partners' => self::getPartner(),
            'types' => Utilities::POST_TYPE,
            'statuses' => [
                [
                    'value' => '',
                    'label' => 'All',
                ],
                [
                    'value' => 'active',
                    'label' => 'Active',
                ],
                [
                    'value' => 'pending',
                    'label' => 'Pending',
                ],
                [
                    'value' => 'hold',
                    'label' => 'Hold',
                ],
            ],
        ]);
    }
}
