<?php

namespace Modules\Front\Livewire\Layouts\Navbar;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $customer = auth('customer')->user();
        return view('front::livewire.layouts.navbar.cart', [
            'total_items' => $customer ? ($customer->cart ? $customer->cart->items_count : 0) : 0
        ]);
    }
}
