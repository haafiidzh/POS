<?php

use Illuminate\Support\Facades\Route;
use Modules\Administrator\Http\Controllers\AdministratorController;
use Modules\Administrator\Http\Controllers\AppSettingController;
use Modules\Administrator\Http\Controllers\CategoryController;
use Modules\Administrator\Http\Controllers\CmsController;
use Modules\Administrator\Http\Controllers\CouponController;
use Modules\Administrator\Http\Controllers\CourseCategoryController;
use Modules\Administrator\Http\Controllers\CourseController;
use Modules\Administrator\Http\Controllers\CourseTypeController;
use Modules\Administrator\Http\Controllers\CustomerController;
use Modules\Administrator\Http\Controllers\EcommerceSettingsController;
use Modules\Administrator\Http\Controllers\FaqCategoryController;
use Modules\Administrator\Http\Controllers\FaqController;
use Modules\Administrator\Http\Controllers\GuestMessageController;
use Modules\Administrator\Http\Controllers\NavigationController;
use Modules\Administrator\Http\Controllers\OrderController;
use Modules\Administrator\Http\Controllers\PageController;
use Modules\Administrator\Http\Controllers\PermissionController;
use Modules\Administrator\Http\Controllers\PostCategoryController;
use Modules\Administrator\Http\Controllers\ProductCategoryController;
use Modules\Administrator\Http\Controllers\RetributionCategoryController;
use Modules\Administrator\Http\Controllers\PostController;
use Modules\Administrator\Http\Controllers\RetributionController;
use Modules\Administrator\Http\Controllers\ProductController;
use Modules\Administrator\Http\Controllers\ReportController;
use Modules\Administrator\Http\Controllers\RoleController;
use Modules\Administrator\Http\Controllers\SeoController;
use Modules\Administrator\Http\Controllers\SliderController;
use Modules\Administrator\Http\Controllers\TestimonialController;
use Modules\Administrator\Http\Controllers\UserController;
use Modules\Administrator\Http\Controllers\VisitorController;
use Modules\Administrator\Http\Controllers\PartnerController;
use Modules\Administrator\Http\Controllers\HistoryRetributionController;
use Modules\Administrator\Http\Controllers\SalesController;
use Modules\Administrator\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group([
    'prefix' => 'administrator',
    'as' => 'administrator.',
], function () {
    Route::group([
        'middleware' => ['auth:web', 'verified'],
    ], function () {
        Route::get('/', [AdministratorController::class, 'index'])->name('index');
        Route::get('/profile', [AdministratorController::class, 'profile'])->name('profile');
        Route::get('/notifikasi', [AdministratorController::class, 'notification'])->name('notification');

        // // Report
        // Route::group([
        //     'prefix' => 'report',
        //     'as' => 'report.',
        // ], function () {
        //     Route::get('/transaksi', [ReportController::class, 'transaction'])->name('transaction');
        // });

        // Order
        Route::group([
            'prefix' => 'pesanan',
            'as' => 'order.',
        ], function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/tambah', [OrderController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
        });

        // Content
        Route::group([
            'prefix' => 'konten',
            'as' => 'content.',
        ], function () {
            Route::get('/', [CmsController::class, 'index'])->name('index');
            Route::get('/tambah', [CmsController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [CmsController::class, 'edit'])->name('edit');
        });

        // AppSettings
        Route::group([
            'prefix' => 'setting',
            'as' => 'app-setting.',
        ], function () {
            Route::get('/', [AppSettingController::class, 'index'])->name('index');
            Route::get('/tambah', [AppSettingController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [AppSettingController::class, 'edit'])->name('edit');
        });

        // User
        Route::group([
            'prefix' => 'user',
            'as' => 'user.',
        ], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/tambah', [UserController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        });

        // Role
        Route::group([
            'prefix' => 'role',
            'as' => 'role.',
        ], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/tambah', [RoleController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        });

        // Permission
        Route::group([
            'prefix' => 'permission',
            'as' => 'permission.',
        ], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('/tambah', [PermissionController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
        });

        // Page
        Route::group([
            'prefix' => 'halaman',
            'as' => 'page.',
        ], function () {
            Route::get('/', [PageController::class, 'index'])->name('index');
            Route::get('/tambah', [PageController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
        });

        //Customer
        Route::group([
            'prefix' => 'customer',
            'as' => 'customer.',
        ], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/tambah', [CustomerController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
            Route::get('/{id}/sertifikat/{certificate_id}', [CourseController::class, 'generateCertificate'])->name('course-certificate');
        });

        // Post
        Route::group([
            'prefix' => 'artikel',
            'as' => 'post.',
        ], function () {

            // Article
            Route::group([
                'as' => 'article.',
            ], function () {
                Route::get('/', [PostController::class, 'index'])->name('index');
                Route::get('/tambah', [PostController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
            });

            // Post Category
            Route::group([
                'prefix' => 'kategori',
                'as' => 'category.',
            ], function () {
                Route::get('/', [PostCategoryController::class, 'index'])->name('index');
                Route::get('/tambah', [PostCategoryController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [PostCategoryController::class, 'edit'])->name('edit');
            });
        });


        // Product
        Route::group([
            'prefix' => 'produk',
            'as' => 'product.',
        ], function () {


            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/tambah', [ProductController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');

            // Post Category
            Route::group([
                'prefix' => 'kategori',
                'as' => 'category.',
            ], function () {
                Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
                Route::get('/tambah', [ProductCategoryController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('edit');
            });
        });



        // Retribution
        Route::group([
            'prefix' => 'retribusi',
            'as' => 'retribution.',
        ], function () {


            Route::get('/', [RetributionController::class, 'index'])->name('index');
            Route::get('/tambah', [RetributionController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [RetributionController::class, 'edit'])->name('edit');

            // Post Category
            Route::group([
                'prefix' => 'kategori',
                'as' => 'category.',
            ], function () {
                Route::get('/', [RetributionCategoryController::class, 'index'])->name('index');
                Route::get('/tambah', [RetributionCategoryController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [RetributionCategoryController::class, 'edit'])->name('edit');
            });
        });



         // Partner
         Route::group([
            'prefix' => 'partner',
            'as' => 'partner.',
        ], function () {


            Route::get('/', [PartnerController::class, 'index'])->name('index');
            Route::get('/tambah', [PartnerController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [PartnerController::class, 'edit'])->name('edit');

        });

         // Sales
         Route::group([
            'prefix' => 'transaksi',
            'as' => 'transaction.',
        ], function () {
            Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/tambah', [SalesController::class, 'create'])->name('create');
            Route::get('/{id}', [SalesController::class, 'show'])->name('show');
        });

         // Sales
         Route::group([
            'prefix' => 'transaksi',
            'as' => 'transaction.',
        ], function () {
            Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/tambah', [SalesController::class, 'create'])->name('create');
            Route::get('/{id}', [SalesController::class, 'show'])->name('show');
        });

        // Report
        Route::group([
            'prefix' => 'report',
            'as' => 'report.',
        ], function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
        });

         // Partner
         Route::group([
            'prefix' => 'histori',
            'as' => 'history.',
        ], function () {
            Route::get('/', [HistoryRetributionController::class, 'index'])->name('index');
            // Route::get('/tambah', [HistoryRetributionController::class, 'create'])->name('create');
            // Route::get('/edit/{id}', [HistoryRetributionController::class, 'edit'])->name('edit');
        });



        // Course Route
        Route::group([
            'prefix' => 'kelas',
            'as' => 'course.',
        ], function () {

            // Course Category
            Route::group([
                'as' => 'main.',
            ], function () {
                Route::get('/', [CourseController::class, 'index'])->name('index');
                Route::get('/tambah', [CourseController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
                Route::get('/edit/{id}/vidio', [CourseController::class, 'video'])->name('video');
                Route::get('/edit/{id}/silabus', [CourseController::class, 'step'])->name('step');
                Route::get('/edit/{id}/harga', [CourseController::class, 'price'])->name('price');
                Route::get('/edit/{id}/pengaturan', [CourseController::class, 'setting'])->name('setting');
                Route::get('/edit/{id}/review', [CourseController::class, 'review'])->name('review');
            });

            // Course Category
            Route::group([
                'prefix' => 'kategori',
                'as' => 'category.',
            ], function () {
                Route::get('/', [CourseCategoryController::class, 'index'])->name('index');
            });

            // Course Type
            Route::group([
                'prefix' => 'tipe',
                'as' => 'type.',
            ], function () {
                Route::get('/', [CourseTypeController::class, 'index'])->name('index');
                Route::get('/tambah', [CourseTypeController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [CourseTypeController::class, 'edit'])->name('edit');
            });
        });

        // Ecommerce Route
        Route::group([
            'prefix' => 'e-commerce',
            'as' => 'e-commerce.',
        ], function () {

            // Settings
            Route::group([
                'prefix' => 'settings',
                'as' => 'setting.',
            ], function () {
                // Coupon
                Route::group([
                    'prefix' => 'kupon',
                    'as' => 'coupon.',
                ], function () {
                    Route::get('/', [CouponController::class, 'index'])->name('index');
                    Route::get('/tambah', [CouponController::class, 'create'])->name('create');
                    Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('edit');
                });
                // Coupon
                Route::group([
                    'prefix' => 'general',
                    'as' => 'general.',
                ], function () {
                    Route::get('/', [EcommerceSettingsController::class, 'index'])->name('index');
                    Route::get('/edit/{id}', [EcommerceSettingsController::class, 'edit'])->name('edit');
                });
            });
        });

        // Settings Route
        Route::group([
            'prefix' => 'pengaturan',
            'as' => 'setting.',
        ], function () {

            // Navigation
            Route::group([
                'prefix' => 'utama',
                'as' => 'main.',
            ], function () {
                Route::get('/', [AppSettingController::class, 'index'])->name('index');
                Route::get('/tambah', [AppSettingController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [AppSettingController::class, 'edit'])->name('edit');
            });

            // Navigation
            Route::group([
                'prefix' => 'navigasi',
                'as' => 'navigation.',
            ], function () {
                Route::get('/', [NavigationController::class, 'index'])->name('index');
                Route::get('/tambah', [CategoryController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            });

            // SEO
            Route::group([
                'prefix' => 'seo',
                'as' => 'seo.',
            ], function () {
                Route::get('/', [SeoController::class, 'index'])->name('index');
                Route::get('/edit/{id}', [SeoController::class, 'edit'])->name('edit');
            });
        });

        //slider
        Route::group([
            'prefix' => 'slider',
            'as' => 'slider.',
        ], function () {
            Route::get('/', [SliderController::class, 'index'])->name('index');
            Route::get('/tambah', [SliderController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('edit');
        });


        //visitor
        Route::group([
            'prefix' => 'visitor',
            'as' => 'visitor.',
        ], function () {
            Route::get('/', [VisitorController::class, 'index'])->name('index');
            // Route::get('/download', [VisitorController::class, 'download'])->name('download');
        });

        //testimonial
        Route::group([
            'prefix' => 'testimonial',
            'as' => 'testimonial.',
        ], function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('index');
            Route::get('/tambah', [TestimonialController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        });

        // Faq
        Route::group([
            'prefix' => 'faq',
            'as' => 'faq.',
        ], function () {
            // Faq
            Route::group([
                'as' => 'main.',
            ], function () {
                Route::get('/', [FaqController::class, 'index'])->name('index');
                Route::get('/tambah', [FaqController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('edit');
            });

            // Faq Category
            Route::group([
                'prefix' => 'kategori',
                'as' => 'category.',
            ], function () {
                Route::get('/', [FaqCategoryController::class, 'index'])->name('index');
            });
        });

        // Guest Message
        Route::group([
            'prefix' => 'pesan-publik',
            'as' => 'guestmessage.',
        ], function () {
            Route::get('/', [GuestMessageController::class, 'index'])->name('index');
        });
    });
});
