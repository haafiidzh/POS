<?php

namespace Modules\Administrator\Livewire\Dashboard;

use Livewire\Component;
use Modules\Common\Contracts\WithThirdParty;
use Modules\Common\Models\GuestMessage;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;
use Modules\Customer\Services\Repositories\CustomerRepo;
use Modules\ECommerce\Models\Order;
use Modules\ECommerce\Services\Repositories\OrderRepo;

class Summary extends Component
{
    use WithThirdParty, FlashMessage;

    /**
     * Define string props
     * @var string
     */
    public ?string $order_status = 'pending';
    public ?string $customer_status = 'all';

    /**
     * Define array props
     * @var array
     */
    public $dates = [
        'start' => '',
        'end' => '',
    ];

    /**
     * Define event listeners
     * @var array
     */
    public $listeners = [
        self::UPDATED_DATERANGEPICKER,
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(array $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Hooks for date range picker property
     * Doing date range picker validation after
     * Date property has been updated
     *
     * @param  array $value
     * @return void
     */
    public function updatedDaterangePicker(array $value)
    {
        $this->dates = $value;
    }

    /**
     * Count order by status
     * @return Order
     */
    public function countOrder()
    {
        return (new OrderRepo)->countOrder($this->order_status, $this->dates);
    }

    /**
     * Count customer by status
     * @return Customer
     */
    public function countCustomer()
    {
        return (new CustomerRepo)->countCustomer($this->customer_status, $this->dates);
    }

    /**
     * Count guest message
     * @return GuestMessage
     */
    public function countGuestMessage()
    {
        return GuestMessage::whereNull('seen_at')->where(function ($query) {
            return $query->whereDate('created_at', '>=', $this->dates['start'])
                ->whereDate('created_at', '<=', $this->dates['end']);
        })->count();
    }

    /**
     * Listing of order status
     * @return array
     */
    public function orderStatus()
    {
        return [
            [
                'value' => 'pending',
                'label' => 'Tertunda',
            ],
            [
                'value' => 'complete',
                'label' => 'Selesai',
            ],
            [
                'value' => 'expired',
                'label' => 'Kadaluwarsa',
            ],
        ];
    }

    /**
     * Listing of order status
     * @return array
     */
    public function customerStatus()
    {
        return [
            [
                'value' => 'all',
                'label' => 'Semua',
            ],
            [
                'value' => 'verified',
                'label' => 'Terverifikasi',
            ],
            [
                'value' => 'not-verified',
                'label' => 'Belum Terverifikasi',
            ],
        ];
    }

    /**
     * Get label from option filter
     *
     * @param  string $term
     * @return string
     */
    public function getLabel(string $term = '')
    {
        if ($term == 'order') {
            $status = self::orderStatus();
            $search = array_search($this->order_status, array_column($status, 'value'));
            return isset($status[$search]['label']) ? $status[$search]['label'] : '-';
        }

        if ($term == 'customer') {
            $status = self::customerStatus();
            $search = array_search($this->customer_status, array_column($status, 'value'));
            return isset($status[$search]['label']) ? $status[$search]['label'] : '-';
        }

        return '-';
    }

    public function render()
    {
        return view('administrator::livewire.dashboard.summary', [
            'count' => [
                // 'order' => self::countOrder(),
                // 'customer' => self::countCustomer(),
                'guest_message' => self::countGuestMessage(),
            ],
            'statuses' => [
                'order' => self::orderStatus(),
                'customer' => self::customerStatus(),
            ],
            'switch' => [
                'order' => self::getLabel('order'),
                'customer' => self::getLabel('customer'),
            ],
        ]);
    }
}
