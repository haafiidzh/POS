<?php

namespace Modules\Front\Livewire\Customer\Order;

use Livewire\Component;
use Modules\Common\Contracts\WithModal;
use Modules\ECommerce\Models\Order;
use Modules\ECommerce\Services\Repositories\OrderRepo;

class Listing extends Component
{
    /**
     * Define string property
     * @var string
     */
    public $menu = 'pending';
    public $search = '';

    /**
     * Define itn property
     * @var int
     */
    public $per_page = 10;

    /**
     * Define livewire event listener
     * Livewire hooks
     *
     * @var array
     */
    protected $listeners = [
        'updateMenu'
    ];

    /**
     * Set property value before component rendered
     *
     * @param  string $menu
     * @return void
     */
    public function mount($menu = 'pending')
    {
        $this->search = request()->query('search');
        $this->menu = $menu;
    }

    /**
     * Update menu callback
     *
     * @param  string $menu
     * @return void
     */
    public function updateMenu($menu)
    {
        $this->menu  = $menu;
        $this->reset('search', 'per_page');
    }

    /**
     * Show order and notify show class
     *
     * @param  int $order_id
     * @return void
     */
    public function showOrder($order_id)
    {
        return $this->dispatch('showOrder', $order_id)->to(Show::class);
    }

    /**
     * Load more order data
     * @return void
     */
    public function loadMore()
    {
        $this->per_page += 10;
    }

    /**
     * Get all order from resource
     * @return void
     */
    public function getAll()
    {
        return (new OrderRepo)->filters((object) [
            'search' => $this->search,
            'tab' => $this->menu,
            'sort' => 'created_at',
            'order' => 'desc',
        ], $this->per_page);
    }

    public function render()
    {
        return view('front::livewire.customer.order.listing', [
            'items' => self::getAll(),
        ]);
    }
}
