<?php

namespace Modules\Front\Livewire\Customer;

use Livewire\Component;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;
use Modules\Front\Livewire\Customer\Notification\Listing;
use Modules\Front\Traits\Livewire\Ecommerce;

class Notification extends Component
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
        'menu',
    ];

    /**
     * Define props value before component rendered
     * @return void
     */
    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->customer_id = $customer->id;
        $this->menu = request()->query('menu') ?: 'all';
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
            [
                'label' => 'Semua Notifikasi',
                'description' => 'Semua notifikasi yang Anda dapatkan',
                'icon' => 'bx bx-bell',
                'menu' => 'all',
                'active' => $this->menu == 'all' ? true : false,
            ],
            [
                'label' => 'Belum Dibaca',
                'description' => 'Semua notifikasi yang belum Anda lihat',
                'icon' => 'bx bx-hide',
                'menu' => 'unseen',
                'active' => $this->menu == 'unseen' ? true : false,
            ],
            [
                'label' => 'Dibaca',
                'description' => 'Semua notifikasi yang telah Anda lihat',
                'icon' => 'bx bx-show',
                'menu' => 'seen',
                'active' => $this->menu == 'seen' ? true : false,
            ],
        ];
    }

    public function render()
    {
        return view('front::livewire.customer.notification', [
            'menus' => self::menus(),
        ]);
    }
}
