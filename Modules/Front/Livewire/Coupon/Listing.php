<?php

namespace Modules\Front\Livewire\Coupon;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ECommerce\Models\Coupon;

class Listing extends Component
{
    use WithPagination;

    /**
     * Define string property
     * @var string
     */
    public string $search = '';

    /**
     * Define int property
     * @var int
     */
    public int $per_page = 10;

    /**
     * Get all coupons
     *
     * @return Coupon
     */
    public function getAll()
    {
        return Coupon::active()
            ->when($this->search, function ($query) {
                return $query->search((object)[
                    'search' => $this->search
                ]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->per_page);
    }

    /**
     * Show coupon and notify show class
     *
     * @param  int $coupon_id
     * @return void
     */
    public function showCoupon($coupon_id)
    {
        return $this->dispatch('showCoupon', $coupon_id)->to(Show::class);
    }

    /**
     * Hooks for apply filter
     * @return void
     */
    public function applyFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('front::livewire.coupon.listing', [
            'coupons' => self::getAll()
        ]);
    }
}
