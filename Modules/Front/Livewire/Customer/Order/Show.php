<?php

namespace Modules\Front\Livewire\Customer\Order;

use Livewire\Component;
use Modules\ECommerce\Models\Order;
use Modules\Common\Contracts\WithModal;

class Show extends Component
{
    use WithModal;

    /**
     * Define order class
     * @var Order $order
     */
    public Order $order;

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::INIT_MODAL,
        self::CLOSE_MODAL,
        'showOrder'
    ];

    /**
     * When modal initiated, set loading to true
     * @return void
     */
    public function initModal()
    {
        $this->loading = true;
    }

    /**
     * When wodal closed, set loading to false and reset order
     * @return void
     */
    public function closeModal()
    {
        $this->loading = false;
        $this->reset('order');
    }
    /**
     * Show order callback
     *
     * @param  int $order_id
     * @return void
     */
    public function showOrder($order_id)
    {
        $this->order = Order::with('details')->where('id', $order_id)->first();
        $this->loading = false;
    }

    public function render()
    {
        return view('front::livewire.customer.order.show');
    }
}
