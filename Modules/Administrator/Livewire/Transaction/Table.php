<?php

namespace Modules\Administrator\Livewire\Transaction;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Administrator\Services\Repositories\TransactionRepo;

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
    public $headers = [
        [
            'cell_name' => 'Nama',
            'column_name' => 'name',
            'sortable' => true,
        ],
        [
            'cell_name' => 'Deskripsi',
            'column_name' => 'description',
            'sortable' => false,
        ],
        [
            'cell_name' => 'Status',
            'column_name' => null,
            'sortable' => false,
        ],
        [
            'cell_name' => 'Dibuat Pada',
            'column_name' => 'created_at',
            'sortable' => true,
        ],
        [
            'cell_name' => 'Aksi',
            'column_name' => null,
            'sortable' => false,
        ],
    ];

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

    public function render()
    {
        return view('administrator::livewire.transaction.table', [
            'datas' => $this->getAll(),
        ]);
    }
}
