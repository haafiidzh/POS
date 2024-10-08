<?php

namespace Modules\Administrator\Livewire\Product;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Constants\Utilities;
use Modules\Common\Contracts\WithRemoveModal;
use Modules\Common\Models\Category;
use Modules\Common\Models\Product;
use Modules\Common\Services\ImageService;
use Modules\Common\Services\Repositories\ProductRepo;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Core\Models\User;
use stdClass;

class Table extends Component
{
    use WithPagination, WithRemoveModal, FlashMessage;

    /**
     * Defines string props
     * @var string
     */
    public string $category = '';
    public string $type = '';
    public string $status = '';
    public string $sort = 'created_at';
    public string $order = 'desc';
    public string $search = '';
    public string $partner = '';
    public string $creator = '';



    public string $destroyId = '';



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
    public function getCategories()
    {
        $prepend = new stdClass;
        $prepend->name = 'Semua Kategori';
        $prepend->slug = null;

        return Category::select(['name', 'slug'])
            ->where(function ($category) {
                $category->has('parent')
                    ->orDoesntHave('childs');
            })
            ->where('group', 'like', '%products%')
            ->get()
            ->prepend(($prepend));
    }




    /**
     * Get all posts from database
     * @return void
     */
    public function getAllProduct()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Determine the value of 'user_id' based on the user's role
        $userId = $user->hasRole(['Mitra'], 'web')  ? $user->id : null;

        return (new ProductRepo())->filters((object) [
            'category' => $this->category,
            'type' => $this->type,
            'status' => $this->status,
            'author' => null,
            'sort' => $this->sort,
            'order' => $this->order,
            'search' => $this->search,
            'creator' => $this->creator,
            'user_id' => $userId, // Set 'user_id' based on the user's role
        ], $this->per_page);
    }

    /**
     * Change post status bocome archive or publish
     *
     * @param  string $id
     * @return void
     */
    public function archive(?string $id)
    {
        try {
            $post = Product::find($id);

            if (!$post) {
                throw new Exception('Produk tidak ditemukan, Produk gagal dihapus.');
            }

            $text = $post->archived_at ? 'Produk berhasil dipulihkan.' : 'Produk berhasil diarsipkan.';
            $post->update([
                'published_at' => $post->published_at ? null : now()->toDateTimeString(),
                'archived_at' => $post->archived_at ? null : now()->toDateTimeString(),
            ]);

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
            $post = Product::where('id', $this->destroyId)->withTrashed()->first();

            if (!$post) {
                throw new Exception('Produk tidak ditemukan, Produk gagal dihapus.');
            }

            // Check if post have a thumbnail
            if ($post->thumbnail) {
                // Remove existing thumbnail
                (new ImageService)->removeImage('images', $post->thumbnail);
            }

            // Force delete
            $post->forceDelete();
            $this->reset('destroyId');

            return $this->dispatchSuccess('Produk berhasil dihapus.', true);
        } catch (Exception $exception) {
            $this->reset('destroyId');
            return $this->dispatchError($exception->getMessage(), true);
        }
    }



    public function getPartner()
    {
        return User::all();
    }

    public function testFunction()
    {
        dd('Function called');
        session()->flash('message', 'Button clicked!');
    }


    public function render()
    {
        $user = auth()->user();

        return view('administrator::livewire.product.table', [
            'datas' => self::getAllProduct(),
            'categories' => self::getCategories(),
            'creators' => self::getPartner(),
            'types' => Utilities::POST_TYPE,
            'statuses' => [
                [
                    'value' => '',
                    'label' => 'All',
                ],
                [
                    'value' => 'published',
                    'label' => 'Published',
                ],
                [
                    'value' => 'draft',
                    'label' => 'Draft',
                ],
                [
                    'value' => 'archived',
                    'label' => 'Archived',
                ],
            ],
        ]);
    }
}
