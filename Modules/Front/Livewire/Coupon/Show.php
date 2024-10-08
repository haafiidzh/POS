<?php

namespace Modules\Front\Livewire\Coupon;

use Livewire\Component;
use Modules\ECommerce\Models\Coupon;
use Modules\Common\Contracts\WithModal;

class Show extends Component
{
    use WithModal;

    /**
     * Define coupon class
     * @var Coupon $coupon
     */
    public Coupon $coupon;

    /**
     * Define livewire event listeners
     * @var array
     */
    protected $listeners = [
        self::INIT_MODAL,
        self::CLOSE_MODAL,
        'showCoupon'
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
     * When wodal closed, set loading to false and reset coupon
     * @return void
     */
    public function closeModal()
    {
        $this->loading = false;
        $this->reset('coupon');
    }
    /**
     * Show coupon callback
     *
     * @param  int $coupon_id
     * @return void
     */
    public function showCoupon($coupon_id)
    {
        sleep(0.5);
        $this->coupon = Coupon::find($coupon_id);
        $this->loading = false;
    }

    public function render()
    {
        return view('front::livewire.coupon.show');
    }
}
