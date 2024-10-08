<?php

namespace Modules\Front\Livewire\Customer;

use Livewire\Component;
use Modules\Common\Traits\Utils\FlashMessage;
use Modules\Customer\Models\Customer;
use Modules\Front\Traits\Livewire\Ecommerce;

class Setting extends Component
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
        $this->menu = request()->query('menu') ?: 'profile';
    }

    /**
     * Define menu in profile
     * @return array
     */
    public function menus()
    {
        return [
            [
                'label' => 'Profil',
                'description' => 'Avatar, nama lengkap, dan email',
                'icon' => 'bx bx-user',
                'menu' => 'profile',
                'active' => $this->menu == 'profile' ? true : false,
            ],
            [
                'label' => 'Informasi Tagihan',
                'description' => 'Nama, Gender, Alamat, Telpon dan WhatsApp',
                'icon' => 'bx bx-file',
                'menu' => 'billing-information',
                'active' => $this->menu == 'billing-information' ? true : false,
            ],
            [
                'label' => 'Ubah Kata Sandi',
                'description' => 'Kata Sandi',
                'icon' => 'bx bx-lock-alt',
                'menu' => 'change-password',
                'active' => $this->menu == 'change-password' ? true : false,
            ],
        ];
    }

    public function render()
    {
        return view('front::livewire.customer.setting', [
            'menus' => self::menus(),
        ]);
    }
}
