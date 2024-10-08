<?php

namespace Modules\Front\Livewire\Layouts;

use Livewire\Component;
use Modules\Common\Models\Category;
use Illuminate\Support\Facades\Route;

class Navbar extends Component
{
    /**
     * Define menu on the front sidebar
     * @return array
     */
    public function menu()
    {
        return [
            [
                'name' => 'Beranda',
                'active' => activeRouteIs('front.index', 'active') == 'active' ? true : false,
                'link' => Route::has('front.index') ? route('front.index') : 'javascript:void(0)',
                'childs' => [],
            ],
            // [
            //     'name' => 'Kelas',
            //     'active' => activeRouteIs(['front.course.*'], 'active') == 'active' ? true : false,
            //     'link' => 'javascript:void(0)',
            //     'childs' => self::mapCourseCategory(),
            // ],
            [
                'name' => 'FAQ',
                'active' => activeRouteIs('front.faq', 'active') == 'active' ? true : false,
                'link' => Route::has('front.faq') ? route('front.faq') : 'javascript:void(0)',
                'childs' => [],
            ],
            [
                'name' => 'Hubungi Kami',
                'active' => activeRouteIs('front.contact', 'active') == 'active' ? true : false,
                'link' => Route::has('front.contact') ? route('front.contact') : 'javascript:void(0)',
                'childs' => [],
            ],
        ];
    }

    /**
     * Define customer dropdown
     * @return array
     */
    public function customerDropdown()
    {
        return [
            [
                'name' => 'Dashboard',
                'icon' => 'bx bx-tv text-lg mr-2',
                'link' => Route::has('customer.index') ? route('customer.index') : 'javascript:void(0)',
            ],
            [
                'name' => 'Kelas Saya',
                'icon' => 'bx bx-book-open text-lg mr-2',
                'link' => Route::has('customer.course') ? route('customer.course') : 'javascript:void(0)',
            ],
            [
                'name' => 'Profil',
                'icon' => 'bx bx-user text-lg mr-2',
                'link' => Route::has('customer.profile') ? route('customer.profile') : 'javascript:void(0)',
            ],
            [
                'name' => 'Pesanan',
                'icon' => 'bx bx-cart-alt text-lg mr-2',
                'link' => Route::has('customer.order') ? route('customer.order') : 'javascript:void(0)',
            ],
            [
                'name' => 'Notifikasi',
                'icon' => 'bx bx-bell text-lg mr-2',
                'link' => Route::has('customer.notification') ? route('customer.notification') : 'javascript:void(0)',
            ],
        ];
    }

    /**
     * Get all course category
     * @return Category
     */
    public function getCourseCategory()
    {
        return Category::query()->select(['name', 'slug'])
            ->active()
            ->where('group', 'courses')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->limit(10)
            ->get();
    }

    /**
     * Mapping course category into new format
     * @return array
     */
    public function mapCourseCategory()
    {
        $childs = [
            [
                'name' => 'Semua Kelas',
                'active' => activeRouteIs('front.course.index', 'active') == 'active' ? true : false,
                'link' => Route::has('front.course.index') ? route('front.course.index') : 'javascript:void(0)',
            ],
            [
                'name' => 'divider',
                'active' => null,
                'link' => null,
            ],
        ];

        $categories = self::getCourseCategory();
        foreach ($categories as $category) {
            array_push($childs, [
                'name' => $category->name,
                'active' => activeRouteIs('front.course.category', 'active') == 'active' ? true : false,
                'link' => Route::has('front.course.category') ? route('front.course.category', $category->slug) : 'javascript:void(0)',
            ]);
        }

        return $childs;
    }

    public function render()
    {
        return view('front::livewire.layouts.navbar', [
            'menus' => self::menu(),
            'customer' => $customer = auth('web')->user(),
            'customer_menus' => self::customerDropdown(),
            'role' => optional($customer)->getRoleNames(),
        ]);
    }
}