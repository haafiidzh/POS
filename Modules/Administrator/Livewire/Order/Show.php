<?php

namespace Modules\Administrator\Livewire\Order;

use Livewire\Component;
use Modules\Common\Contracts\WithModal;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\ECommerce\Models\Order;

class Show extends Component
{
    use WithModal, FlashMessage;

    public $order;
    public $order_code;

    /**
     * Define livewire event listeners used
     *
     * @var array
     */
    protected $listeners = [
        'cleanUp',
        'showOrder',
        self::INIT_MODAL,
        self::CLOSE_MODAL,
    ];

    /**
     * Reset all properties and error bags
     * @return void
     */
    public function cleanUp()
    {
        $this->closeModal();
        return $this->reset('order_code', 'order');
    }

    /**
     * Handle show order detail by specific order code and authenticated customer
     * @param  string $order_code
     * @return void
     */
    public function showOrder($order_code)
    {
        // throw abort(500);
        $this->order_code = $order_code;
        $this->order = Order::where('order_code', $order_code)->first();
    }

    public function render()
    {
        return view('administrator::livewire.order.show', ['order' => $this->order]);
    }
}
