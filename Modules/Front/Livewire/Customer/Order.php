<?php

namespace Modules\Front\Livewire\Customer;

use Livewire\Component;
use Modules\ECommerce\Models\Order as OrderModel;
use Modules\Customer\Models\Customer;
use Modules\Front\Traits\Livewire\Ecommerce;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Front\Livewire\Customer\Order\Listing;

class Order extends Component
{
    use FlashMessage, Ecommerce;

    /**
     * Define customer props
     * @var Customer $customer
     */
    public Customer $customer;

    /**
     * Define strign props
     * @var ?string
     */
    public ?string $customer_id = '';
    public ?string $menu = '';

    /**
     * Define array props
     * @var array
     */
    public array $queryString = [
        'menu'
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->customer_id = $customer->id;
        $this->menu = request()->query('menu') ?: 'pending';
    }

    /**
     * Hooks for updated event for menu property
     *
     * @param  string $value
     * @return void
     */
    public function updatedMenu($value)
    {
        return $this->dispatch('updateMenu', $value)->to(Listing::class);
    }

    /**
     * Define menu in all
     * @return array
     */
    public function menus()
    {
        return [
            // [
            //     'label' => 'Semua Status',
            //     'description' => 'Semua pesanan saya',
            //     'icon' => 'bx bx-file',
            //     'menu' => 'all',
            //     'active' => $this->menu == 'all' ? true : false,
            // ],
            [
                'label' => 'Menunggu Pembayaran',
                'description' => 'Pesanan saya yang belum terbayar',
                'icon' => 'bx bx-wallet',
                'menu' => 'pending',
                'active' => $this->menu == 'pending' ? true : false,
            ],
            [
                'label' => 'Selesai',
                'description' => 'Pesanan saya dengan status selesai',
                'icon' => 'bx bx-check-circle',
                'menu' => 'complete',
                'active' => $this->menu == 'complete' ? true : false,
            ],
            [
                'label' => 'Kadaluarsa',
                'description' => 'Pesanan saya dengan status kadaluarsa',
                'icon' => 'bx bx-x-circle',
                'menu' => 'expired',
                'active' => $this->menu == 'expired' ? true : false,
            ],
            // [
            //     'label' => 'Gagal',
            //     'description' => 'Pesanan saya dengan status gagal',
            //     'icon' => 'bx bx-x-circle',
            //     'menu' => 'cancel',
            //     'active' => $this->menu == 'cancel' ? true : false,
            // ],
        ];
    }

    public function render()
    {
        return view('front::livewire.customer.order', [
            'menus' => self::menus(),
        ]);
    }
}
