<?php

namespace Modules\Administrator\Livewire\Page;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Models\Page;
use Modules\Common\Services\Repositories\PageRepo;
use Modules\Common\Utils\CustomTable;


class Table extends Component
{
    use WithPagination;

    /**
     * Defines the properties used
     * in this component
     *
     * @var string
     */
    public $filters;
    public $sort = 'created_at';
    public $order = 'desc';
    public $search;
    public $destroyId;
    public $per_page = 10;

    /**
     * Define query string used
     * in this component
     *
     * @var array
     */
    protected $queryString = [
        'search', 'sort', 'order',
    ];

    /**
     * Define table headers
     *
     * @var array
     */
    public function headers() { [
        [
            'cell_name' => 'Nama Halaman',
            'column_name' => 'title',
            'sortable' => true,
        ],
        [
            'cell_name' => 'Deskripsi Singkat',
            'column_name' => 'short_description',
            'sortable' => false,
        ],
        [
            'cell_name' => 'Status',
            'column_name' => 'is_active',
            'sortable' => false,
        ],
        [
            'cell_name' => 'Dibuat Pada',
            'column_name' => 'created_at',
            'sortable' => false,
        ],
        [
            'cell_name' => 'Aksi',
            'column_name' => null,
            'sortable' => false,
        ],
    ];
}

    /**
     * Define props value before component rendered
     *
     * @return void
     */
    public function mount()
    {
        $this->sort = request('sort') ?: 'created_at';
        $this->order = request('order') ?: 'desc';
        $this->search = request('search');
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

        if (!$this->order) {
            $this->order = 'asc';
        } elseif ($this->order == 'asc') {
            $this->order = 'desc';
        } elseif ($this->order == 'desc') {
            $this->sort = null;
            $this->order = null;
        }
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
     * To handle reset search property
     * When button with attribute wire:click={resetSearch}
     * This method will be running
     *
     * @return void
     */
    public function resetSearch()
    {
        $this->reset('search');
    }

    /**
     * To handle apply filter property
     * When button with attribute wire:click={searchFilters}
     * This method will be running
     *
     * @return void
     */
    public function searchFilters()
    {
        $this->resetPage();

        // if (!$this->property) {
        //     $this->reset('property');
        // }
    }

    /**
     * To handle reset filter property
     * When button with attribute wire:click={resetFilter}
     * This method will be running
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->resetPage();

        // $this->reset('...props');
    }

    /**
     * Get all Page data from resource
     *
     * @return void
     */
    public function getAll()
    {
        return (new PageRepo())->filters((object) [
            'search' => $this->search,
            'sort' => $this->sort,
            'order' => $this->order,
        ], $this->per_page);
    }

    /**
     * Destroy page from resource
     *
     * @return void
     */
    public function destroy()
    {
        try {
            $page = Page::find($this->destroyId);
            $page->delete();

            $this->dispatch('close-modal');

            return session()->flash('success', 'Halaman web berhasil dihapus.');
        } catch (Exception $exception) {
            return session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        $table = new CustomTable;
        $table->columns(self::headers());
        return view('administrator::livewire.page.table', [
            'table' => $table,
            'datas' => $this->getAll(),
        ]);
    }
}
