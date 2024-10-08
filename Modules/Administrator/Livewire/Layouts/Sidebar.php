<?php

namespace Modules\Administrator\Livewire\Layouts;

use Livewire\Component;

class Sidebar extends Component
{
    /**
     * Define menu on the administrator sidebar
     * @return array
     */
    public function menu()
    {
        return [
            [
                'name' => 'Dashboard',
                'active' => activeRouteIs('administrator.index', 'active') == 'active' ? true : false,
                'active_child' => null,
                'link' => route('administrator.index'),
                'permissions' => ['read.dashboard'],
                'icon' => 'bx bx-home-alt',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Laporan',
                'active' => activeRouteIs(''),
                'link' => null,
                'permissions' => [
                    'read.report-order',
                    'read.report-transaction',
                ],
                'icon' => '',
                'is_separator' => true,
                'childs' => [],
            ],
            // [
            //     'name' => 'Transaksi',
            //     'active' => activeRouteIs('administrator.report.transaction', 'active') == 'active' ? true : false,
            //     'link' => route('administrator.report.transaction'),
            //     'permissions' => ['read.report-transaction'],
            //     'icon' => 'bx bx-chart',
            //     'is_separator' => false,
            //     'childs' => [],
            // ],
            [
                'name' => 'Pesan Publik',
                'active' => activeRouteIs('administrator.guestmessage.*', 'active') == 'active' ? true : false,
                'link' => route('administrator.guestmessage.index'),
                'permissions' => ['read.guest_message'],
                'icon' => 'bx bx-message-dots',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Website',
                'active' => activeRouteIs(''),
                'link' => null,
                'permissions' => [
                    'read.slider',
                    'read.partner',
                    'read.visitor',
                    'read.article',
                    'read.article-category',
                    'read.product',
                    'read.product-category',
                    'read.retribution',
                    'read.retribution-category',
                    'read.faq',
                    'read.faq-category',
                    'read.page',
                    'read.setting-main',
                    'read.setting-content',
                    'read.setting-seo',
                    'read.setting-navigation',
                ],
                'icon' => '',
                'is_separator' => true,
                'childs' => [],
            ],
            [
                'name' => 'Slider',
                'active' => activeRouteIs('administrator.slider.*', 'active') == 'active' ? true : false,
                'link' => route('administrator.slider.index'),
                'permissions' => ['read.slider'],
                'icon' => 'bx bx-slideshow',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Visitor Website',
                'active' => activeRouteIs('administrator.visitor.*', 'active') == 'active' ? true : false,
                'link' => route('administrator.visitor.index'),
                'permissions' => ['read.visitor'],
                'icon' => 'bx bx-group',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Laporan',
                'active' => activeRouteIs('administrator.report.*', 'active') == 'active' ? true : false,
                'link' => route('administrator.report.index'),
                'permissions' => ['read.partner'],
                'icon' => 'bx bxs-report',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Transaksi',
                'active' => activeRouteIs('administrator.transaction.*', 'active') == 'active' ? true : false,
                'link' => route('administrator.transaction.index'),
                'permissions' => ['read.partner'],
                'icon' => 'bx bx-bar-chart',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Partner',
                'active' => activeRouteIs('administrator.partner.*', 'active') == 'active' ? true : false,
                'link' => route('administrator.partner.index'),
                'permissions' => ['read.partner'],
                'icon' => 'bx bx-group',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Artikel',
                'active' => activeRouteIs(['administrator.post.article.*', 'administrator.post.category.*'], 'active') == 'active' ? true : false,
                'link' => 'javascript:void(0)',
                'permissions' => [
                    'create.article',
                    'read.article',
                    'read.article-category',
                ],
                'icon' => 'bx bx-news',
                'is_separator' => false,
                'childs' => [
                    [
                        'name' => 'Tambah Artikel',
                        'active' => activeRouteIs('administrator.post.article.create', 'active') == 'active' ? true : false,
                        'link' => route('administrator.post.article.create'),
                        'permission' => 'create.article',
                    ],
                    [
                        'name' => 'Semua Artikel',
                        'active' => activeRouteIs(['administrator.post.article.index', 'administrator.post.article.edit'], 'active') == 'active' ? true : false,
                        'link' => route('administrator.post.article.index'),
                        'permission' => 'read.article',
                    ],
                    [
                        'name' => 'Kategori',
                        'active' => activeRouteIs('administrator.post.category.*', 'active') == 'active' ? true : false,
                        'link' => route('administrator.post.category.index'),
                        'permission' => 'create.article-category',
                    ],
                ],
            ],
            [
                'name' => 'Produk',
                'active' => activeRouteIs(['administrator.product.*', 'administrator.category.*'], 'active') == 'active' ? true : false,
                'link' => 'javascript:void(0)',
                'permissions' => [
                    'create.product',
                    'read.product',
                    'read.product-category',
                ],
                'icon' => 'bx bx-news',
                'is_separator' => false,
                'childs' => [
                    [
                        'name' => 'Tambah Produk',
                        'active' => activeRouteIs('administrator.product.create', 'active') == 'active' ? true : false,
                        'link' => route('administrator.product.create'),
                        'permission' => 'create.product',
                    ],
                    [
                        'name' => 'Semua Produk',
                        'active' => activeRouteIs(['administrator.product.index', 'administrator.product.edit'], 'active') == 'active' ? true : false,
                        'link' => route('administrator.product.index'),
                        'permission' => 'read.product',
                    ],
                    [
                        'name' => 'Kategori',
                        'active' => activeRouteIs('administrator.product.category.*', 'active') == 'active' ? true : false,
                        'link' => route('administrator.product.category.index'),
                        'permission' => 'create.product-category',
                    ],
                ],
            ],

            [
                'name' => 'Retribusi',
                'active' => activeRouteIs(['administrator.retribution.*', 'administrator.category.*'], 'active') == 'active' ? true : false,
                'link' => 'javascript:void(0)',
                'permissions' => [
                    'create.retribution',
                    'read.retribution',
                    'read.retribution-category',
                ],
                'icon' => 'bx bx-news',
                'is_separator' => false,
                'childs' => [
                    [
                        'name' => 'Tambah Retribusi',
                        'active' => activeRouteIs('administrator.retribution.create', 'active') == 'active' ? true : false,
                        'link' => route('administrator.retribution.create'),
                        'permission' => 'create.retribution',
                    ],
                    [
                        'name' => 'Semua Retribusi',
                        'active' => activeRouteIs(['administrator.retribution.index', 'administrator.retribution.edit'], 'active') == 'active' ? true : false,
                        'link' => route('administrator.retribution.index'),
                        'permission' => 'read.retribution',
                    ],
                    [
                        'name' => 'Kategori',
                        'active' => activeRouteIs('administrator.retribution.category.*', 'active') == 'active' ? true : false,
                        'link' => route('administrator.retribution.category.index'),
                        'permission' => 'create.retribution-category',
                    ],
                ],
            ],
           
            
            [
                'name' => 'FAQ',
                'active' => activeRouteIs([
                    'administrator.page.index',
                    'administrator.faq.main.*',
                    'administrator.faq.category.*',
                ]),
                'link' => 'javascript:void(0)',
                'permissions' => [
                    'read.faq',
                    'read.faq-category',
                ],
                'icon' => 'bx bx-question-mark',
                'is_separator' => false,
                'childs' => [
                    [
                        'name' => 'Daftar FAQ',
                        'active' => activeRouteIs('administrator.faq.main.*', 'active') == 'active' ? true : false,
                        'link' => route('administrator.faq.main.index'),
                        'permission' => 'read.faq',
                    ],
                    [
                        'name' => 'Kategori FAQ',
                        'active' => activeRouteIs('administrator.faq.category.*', 'active') == 'active' ? true : false,
                        'link' => route('administrator.faq.category.index'),
                        'permission' => 'read.faq-category',
                    ],
                ],
            ],

            [
                'name' => 'Pengaturan',
                'active' => activeRouteIs([
                    'administrator.setting.main.index',
                    'administrator.content.index',
                    'administrator.setting.seo.index',
                    'administrator.setting.navigation.index',
                    'administrator.setting.main.edit',
                    'administrator.content.edit',
                    'administrator.setting.seo.edit',
                    'administrator.setting.navigation.edit',
                ], 'active') == 'active' ? true : false,
                'link' => 'javascript:void(0)',
                'permissions' => [
                    'read.setting-main',
                    'read.setting-content',
                    'read.setting-seo',
                    // 'read.setting-navigation',
                ],
                'icon' => 'bx bx-cog',
                'is_separator' => false,
                'childs' => [
                    [
                        'name' => 'Pengaturan Utama',
                        'active' => activeRouteIs(['administrator.setting.main.index', 'administrator.setting.main.edit']),
                        'link' => route('administrator.setting.main.index'),
                        'permission' => 'read.setting-main',
                    ],
                    [
                        'name' => 'Konten Website',
                        'active' => activeRouteIs(['administrator.content.index', 'administrator.content.edit']),
                        'link' => route('administrator.content.index'),
                        'permission' => 'read.setting-content',
                    ],
                    [
                        'name' => 'SEO',
                        'active' => activeRouteIs(['administrator.setting.seo.index', 'administrator.setting.seo.edit']),
                        'link' => route('administrator.setting.seo.index'),
                        'permission' => 'read.setting-seo',
                    ],
                    // [
                    //     'name' => 'Navigasi',
                    //     'active' => activeRouteIs(['administrator.setting.navigation.index', 'administrator.setting.navigation.edit']),
                    //     'link' => route('administrator.setting.navigation.index'),
                    //     'permission' => 'read.setting-navigation',
                    // ],
                ],
            ],
           
            [
                'name' => 'Kontrol Akses',
                'active' => activeRouteIs(''),
                'link' => null,
                'permissions' => [
                    'read.user',
                    'read.role',
                    'read.permission',
                ],
                'icon' => '',
                'is_separator' => true,
                'childs' => [],
            ],
            [
                'name' => 'User',
                'active' => activeRouteIs('administrator.user.*'),
                'link' => route('administrator.user.index'),
                'permissions' => ['read.user'],
                'icon' => 'bx bx-user',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Role',
                'active' => activeRouteIs('administrator.role.*'),
                'link' => route('administrator.role.index'),
                'permissions' => ['read.role'],
                'icon' => 'bx bx-check-shield',
                'is_separator' => false,
                'childs' => [],
            ],
            [
                'name' => 'Permission',
                'active' => activeRouteIs('administrator.permission.*'),
                'link' => route('administrator.permission.index'),
                'permissions' => ['read.permission'],
                'icon' => 'bx bx-fingerprint',
                'is_separator' => false,
                'childs' => [],
            ],
        ];
    }

    public function render()
    {
        return view('administrator::livewire.layouts.sidebar', [
            'menu' => self::menu(),
        ]);
    }
}