<?php

namespace Modules\Front\Livewire;

use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;
use Modules\ECommerce\Actions\Payments\Calculate;
use Modules\ECommerce\Actions\Xendit\Invoice;
use Modules\ECommerce\Models\CartItem;
use Modules\ECommerce\Models\Order;
use Modules\ECommerce\Services\OrderToken;
use Modules\ECommerce\Services\Repositories\CartRepo;
use Modules\ECommerce\Services\Repositories\CouponRepo;
use Modules\ECommerce\Services\Repositories\OrderRepo;

class Checkout extends Component
{
    use FlashMessage;

    /**
     * Define customer props
     * @var Customer $customer
     */
    public Customer $customer;

    /**
     * Define string props
     * @var ?string
     */
    public ?string $token = '';
    public ?string $coupon_code = '';
    public ?string $applied_coupon = '';
    public ?string $phone_number = '';
    public ?string $whatsapp_number = '';

    /**
     * Define bool props
     * @var ?bool
     */
    public bool $terms_conditions = false;

    /**
     * Define props value before component rendered
     *
     * @param Customer $customer
     * @return void
     */
    public function mount(Customer $customer, $token)
    {
        $this->token = $token;
        $this->customer = $customer;
        $this->phone_number = $customer->setting->phone_number;
        $this->whatsapp_number = $customer->setting->whatsapp_number;
    }

    /**
     * Check coupon availibility before
     * customer use to order
     *
     * @return void
     */
    public function checkCoupon()
    {
        $this->reset('applied_coupon');
        try {
            if ($this->coupon_code) {
                (new CouponRepo)->validateCoupon($this->coupon_code);
                $this->applied_coupon = $this->coupon_code;
                return $this->dispatchSuccess('Kupon berhasil diterapkan.');
            }
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Update customer setting -> phone_nummber
     * @return void
     */
    public function updatePhoneNumber()
    {
        try {
            $this->customer->setting()->update([
                'phone_number' => $this->phone_number,
            ]);
            return $this->dispatchSuccess('No. Telpon berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Update customer setting -> whatsapp_nummber
     * @return void
     */
    public function updateWhatsappNumber()
    {
        try {
            $this->customer->setting()->update([
                'whatsapp_number' => $this->whatsapp_number,
            ]);
            return $this->dispatchSuccess('No. Whatsapp berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Update customer setting -> whatsapp_nummber
     * @return void
     */
    public function makeSameAsPhone()
    {
        try {
            $this->whatsapp_number = $this->phone_number;
            $this->customer->setting()->update([
                'whatsapp_number' => $this->whatsapp_number,
            ]);
            return $this->dispatchSuccess('No. Whatsapp berhasil diperbarui.');
        } catch (Exception $exception) {
            return $this->dispatchError($exception->getMessage());
        }
    }

    /**
     * Get all cart items if exsists mark check out
     * @return CartItem
     */
    public function getCheckoutItems()
    {
        return (new CartRepo)->allCheckOutItems();
    }

    /**
     * Remove cart items and checkout token
     *
     * @param  CartItem $items
     * @return void
     */
    public function removeFromCartAndConsumeToken($items)
    {
        (new CartRepo)->markAsCheckedOut($items->pluck('id')->toArray());
        (new OrderToken())->consume($this->token);
    }

    /**
     * Calculate all from chosen cart items
     *
     * @param  CartItem $cart_items
     * @return Calculate
     */
    public function calculate($items)
    {
        return (new Calculate)->items($items)
            ->withTax(true)
            ->withCoupon($this->applied_coupon ? true : false, $this->applied_coupon)
            ->withFee(true)
            ->count();
    }

    /**
     * Cheeckout process from order to xendit
     * @return void
     */
    public function payNow()
    {
        // Return warning toast when tnc phone_number or whatsapp_number
        if (!$this->phone_number && !$this->whatsapp_number) {
            return $this->dispatchError('Anda belum mengisi No. Telpon atau No. Whatsapp.');
        }

        // Return warning toast when tnc didn't checked
        if (!$this->terms_conditions) {
            return $this->dispatchError('Anda belum menyetujui Syarat & Ketentuan yang berlaku.');
        }

        // Order Process
        try {
            // Create db transaction (order)
            DB::beginTransaction();

            // Define variables
            $orderRepo = new OrderRepo;
            $items = self::getCheckoutItems();
            $calculate = self::calculate($items);

            // Create new order from choosen course
            $order = $orderRepo->createOrder(
                $this->customer,
                $items,
                $calculate,
                'course'
            );

            // Create xendit invoice
            $xenditInvoice = (new Invoice)->createXenditInvoice($order);

            // Update order payment when xendit invoice was created
            $order = $orderRepo->updateOrderPayment($order, [
                'id' => $xenditInvoice['id'],
                'payment_method_raw' => null,
                'payment_method' => null,
                'invoice_url' => $xenditInvoice['invoice_url'],
            ]);

            // Commit and make sure all processes are terminated
            DB::commit();

            self::removeFromCartAndConsumeToken($items);

            return redirect()->to($xenditInvoice['invoice_url']);
        } catch (Exception $exception) {
            DB::rollBack();

            if ($exception->getCode() == '23000') {
                return self::payNow();
            }

            $log = createLog('order_failed');
            $log->error($exception);

            $copy = $exception->getMessage();
            return $this->dispatchError('Tampaknya ada yang salah dengan sistem Kami. Silahkan coba beberapa saat lagi.');
        }
    }

    public function render()
    {
        return view('front::livewire.checkout', [
            'items' => $items = self::getCheckoutItems(),
            'calculate' => self::calculate($items),
        ]);
    }
}
