<?php

namespace Modules\Administrator\Livewire\RetributionCategory;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Administrator\Livewire\RetributionCategory\Create;
use Modules\Administrator\Livewire\RetributionCategory\Edit;
use Modules\Common\Contracts\WithRemoveModal;
use Modules\Common\Models\Category;
use Modules\Common\Services\Repositories\CategoryRepo;
use Modules\Common\Traits\Utils\FlashMessage;

class Table extends Component
{
    use WithPagination, WithRemoveModal, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $sort = 'sort_order';
    public ?string $order = 'asc';
    public ?string $group = 'retribution';
    public ?string $destroyId = '';
    public ?string $search = '';

    /**
     * Define int props
     * @var int
     */
    public $per_page = 10;

    /**
     * Define query string used
     * in this component
     *
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
        self::CANCEL,
        self::DESTROY,
        self::FLASH => '$refresh',
    ];

    /**
     * To handle perpage pagination
     *
     * @param  mixed $total
     * @return void
     */
    public function updatedPerPage($total)
    {
        $this->resetPage();
        $this->per_page = $total;
    }

    /**
     * Get all data from resource
     *
     * @return void
     */
    public function getAll()
    {
        return (new CategoryRepo())->filters((object) [
            'search' => $this->search,
            'sort' => $this->sort,
            'order' => $this->order,
            'group' => $this->group,
        ]);
    }

    /**
     * Update banner position while drag n drop
     *
     * @param  mixed $list
     * @return void
     */
    public function updateOrder($list)
    {
        foreach ($list as $item) {
            Category::find($item['value'])->update([
                'sort_order' => $item['order'],
            ]);
        }
    }

    /**
     * Create sub category
     * Dispatch to create category class
     *
     * @param  int|null $id
     * @return void
     */
    public function createSubCategory(?int $id)
    {
        return $this->dispatch('createSubCategory', $id)->to(Create::class);
    }

    /**
     * Edit category or sub category
     * Dispatch to create category class
     *
     * @param  int|null $id
     * @return void
     */
    public function edit(?int $id)
    {
        return $this->dispatch('editCategory', $id)->to(Edit::class);
    }

    /**
     * Updated callback
     * Listen from another component event
     *
     * @return void
     */
    public function updated($property = null, $value = null)
    {
        if ($property !== 'destroyId') {
            $this->resetPage();
        }

        if ($property && !$value) {
            $this->reset($property);
        }
    }

    /**
     * Update banner position while drag n drop
     *
     * @param  array $list
     * @return void
     */
    public function updateCategoryOrder(?array $list)
    {
        foreach ($list as $item) {
            Category::find($item['value'])->update([
                'sort_order' => $item['order'],
            ]);

            foreach ($item['items'] as $child) {
                $sub = Category::find($child['value']);
                $sub->update([
                    'sort_order' => $child['order'],
                ]);
            }
        }
    }

    /**
     * Destroy category from resource
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $category = Category::find($this->destroyId);

            if (!$category) {
                throw new Exception('Kategori Retribusi tidak ditemukan, kategori gagal dihapus.');
            }

            if (!$category->childs->isEmpty()) {
                Category::destroy($category->childs->pluck('id')->toArray());
            }

            $category->delete();
            $this->reset('destroyId');

            return $this->dispatchSuccess('Kategori Retribusi berhasil dihapus.', true);
        } catch (Exception $exception) {
            $this->reset('destroyId');
            return $this->dispatchError($exception->getMessage(), true);
        }
    }

    public function render()
    {
        return view('administrator::livewire.RETRIBUTION-category.table', [
            'categories' => $this->getAll(),
        ]);
    }
}
