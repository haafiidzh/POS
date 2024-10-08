<?php

namespace Modules\Front\Traits\Livewire;

use Exception;
use Illuminate\Support\Facades\Route;
use Modules\Course\Models\Course;
use Modules\Customer\Models\Customer;
use Modules\ECommerce\Models\Cart;
use Modules\ECommerce\Models\CartItem;
use Modules\ECommerce\Services\OrderToken;
use Modules\ECommerce\Services\Repositories\CartRepo;

trait Ecommerce
{
    /**
     * Define constant property
     * @var string
     */
    const PUBLIC_ERROR_MESSAGE = 'Tampaknya ada yang salah dengan sistem Kami. Silahkan coba beberapa saat lagi.';

    /**
     * ecommerceLog
     *
     * @param  mixed $exception
     * @param  string $type
     * @return void
     */
    public function ecommerceLog($exception, $type = 'error')
    {
        if ($type == 'info') {
            $log = createLog('ecommerce-info');
            return $log->info($exception);
        }

        if ($type == 'alert') {
            $log = createLog('ecommerce-alert');
            return $log->alert($exception);
        }

        $log = createLog('ecommerce-error');
        return $log->error($exception);
    }

    /**
     * Logger for exception
     *
     * @param  mixed $exception
     * @return void
     */
    public function execeptionLogger($exception)
    {
        if (str($exception->getCode())->startsWith(4)) {
            return $this->dispatchError($exception->getMessage());
        }

        $this->ecommerceLog($exception);
        return $this->dispatchError(self::PUBLIC_ERROR_MESSAGE);
    }

    /**
     * Update cart items (navbar icon counter)
     * When customer cart has been updated
     *
     * @return void
     */
    public function updatedCartItems()
    {
        try {
            return $this->dispatch('updated-cart', optional(auth('customer')->user()->cart)->items_count);
        } catch (Exception $exception) {
            return $this->execeptionLogger(($exception));
        }
    }

    /**
     * Add to cart event
     * @return void
     */
    public function addToCart(string $course_id)
    {
        try {
            (new CartRepo)->addToCart($course_id);
            $this->updatedCartItems();
            return $this->dispatchSuccess('Kelas berhasil ditambahkan ke keranjang.');
        } catch (Exception $exception) {
            return $this->execeptionLogger(($exception));
        }
    }

    /**
     * Add to cart event
     * @return void
     */
    public function processToCheckoutFromCart()
    {
        try {
            $customer = auth('customer')->user();

            if (!$customer) {
                throw new Exception(419, 'Sesi telah habis. Silahkan login kembali.');
            }

            if (!$customer) {
                throw new Exception('Sesi telah habis. Silahkan login kembali.', 419);
            }

            if ($customer->courses()->whereIn('course_id', $this->choosen_cart)->exists()) {
                throw new Exception('Anda telah memiliki satu atau beberapa kelas yang anda pilih, silahkan pilih kelas lainnya.', 400);
            }

            (new CartRepo)->markAsNotCheckout();
            (new CartRepo)->markAsCheckout($this->choosen_cart);

            $token = new OrderToken();
            $token->setAction('checkout')
                ->generate();

            return redirect()->route(
                'front.checkout',
                [
                    'token' => $token->token,
                    'signature' => $token->signature,
                    'action' => $token->action,
                ]
            );
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Add to cart event
     * @return void
     */
    public function processToCheckoutFromCourse(string $course_id)
    {
        try {
            $customer = auth('customer')->user();

            if (!$customer) {
                throw new Exception('Sesi telah habis. Silahkan login kembali.', 419);
            }

            if ($customer->courses()->where('course_id', $course_id)->exists()) {
                throw new Exception('Anda telah memiliki kelas ini, silahkan pilih kelas lainnya.', 400);
            }

            (new CartRepo)->markAsNotCheckout();
            (new CartRepo)->updateOrCreateCartItem($course_id);

            $token = new OrderToken();
            $token->setAction('checkout')
                ->generate();

            return redirect()->route(
                'front.checkout',
                [
                    'token' => $token->token,
                    'signature' => $token->signature,
                    'action' => $token->action,
                ]
            );
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Give course to customer
     *
     * @param  Customer $customer
     * @param  string $course_id
     * @return void
     */
    public function processFromGift(Customer $customer, $course_id)
    {
        try {
            if (!$customer) {
                throw new Exception('Sesi telah habis. Silahkan login kembali.', 419);
            }

            if ($customer->courses()->where('course_id', $course_id)->exists()) {
                throw new Exception('Pelanggan telah memiliki kelas ini, silahkan pilih kelas lainnya.', 400);
            }

            $cart = Cart::where('customer_id', $customer->id)->first();

            // Handle if customer doesn't have a cart
            if (!$cart) {
                $cart = (new CartRepo)->createCart($customer);
            }

            $find_cart = CartItem::where(['cart_id' => $cart->id, 'course_id' => $course_id])->first();
            if ($find_cart) {
                $find_cart->mark_check_out = 1;
                $find_cart->save();
                $cart_item = $find_cart;
            } else {
                $cart_item = CartItem::create([
                    'cart_id' => $cart->id,
                    'course_id' => $course_id,
                    'quantity' => 1,
                    'mark_check_out' => 1,
                    'checked_out' => 0,
                ]);
            }

            return $cart_item;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
