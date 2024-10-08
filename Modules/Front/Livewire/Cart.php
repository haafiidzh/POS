<?php

namespace Modules\Front\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\URL;
use Modules\Customer\Models\Customer;
use Modules\ECommerce\Models\CartItem;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\ECommerce\Actions\Payments\Calculate;
use Modules\ECommerce\Services\Repositories\CartRepo;
use Modules\Front\Traits\Livewire\Ecommerce;

class Cart extends Component
{
    use FlashMessage, Ecommerce;

    /**
     * Define customer props
     * @var Customer $customer
     */
    public Customer $customer;

    /**
     * Define int props
     * @var ?int
     */
    public ?int $per_page = 10;

    /**
     * Define array props
     * @var ?array
     */
    public ?array $choosen_cart = [];

    /**
     * Define props value before component rendered
     *
     * @param Customer $customer
     * @return void
     */
    public function mount(Customer $customer = null)
    {
        $this->customer = $customer;
    }

    /**
     * Get all customer cart items
     * @return CartItem
     */
    public function getAllCart()
    {
        try {
            return (new CartRepo)->allCartItems($this->per_page);
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }


    /**
     * Calculate all from chosen cart items
     *
     * @param  CartItem $cart_items
     * @return Calculate
     */
    public function calculate($cart_items)
    {
        $calculate = new Calculate();
        if ($this->customer) {
            $items =  $cart_items->whereIn('id', $this->choosen_cart);
            $items->each(function ($item) {
                $item->product->each(function ($product) {
                    $product->thumbnail = $product->getThumbnail();
                });
            });
            $calculate->items($items);
            return $calculate->count();
        }

        return $calculate;
    }

    /**
     * Remove cart item from cart
     *
     * @param  int $cart_item_id
     * @return void
     */
    public function removeCartItem(int $cart_item_id)
    {
        try {
            (new CartRepo)->removeCartItem($cart_item_id);
            $this->updatedCartItems();
            return $this->dispatchSuccess('Kelas berhasil dihapus dari keranjang.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    public function render()
    {
        $cart_items  = self::getAllCart();
        return view('front::livewire.cart', [
            'cart_items' => $cart_items,
            'calculate' => self::calculate($cart_items)
        ]);
    }
}
