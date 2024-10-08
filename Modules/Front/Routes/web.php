<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\Front\CourseController;
use Modules\Front\Http\Controllers\Front\EcommerceController;
use Modules\Front\Http\Controllers\Front\MainController;

Route::group([
    'as' => 'front.',
], function () {
    Route::group([
        'middleware' => ['guest:customer', 'track_visitor'],
    ], function () {
        Route::get('/', [MainController::class, 'index'])->name('index');
        Route::get('/faq', [MainController::class, 'faq'])->name('faq');
        Route::get('/kupon', [MainController::class, 'coupon'])->name('coupon');
        Route::get('/tentang-kami', [MainController::class, 'about'])->name('about');
        Route::get('/hubungi-kami', [MainController::class, 'contact'])->name('contact');
        Route::get('/kebijakan-privasi', [MainController::class, 'privacyPolicy'])->name('privacy-policy');
        Route::get('/syarat-ketentuan', [MainController::class, 'termsAndConditions'])->name('terms-conditions');
        Route::get('/metode-pembayaran', [MainController::class, 'paymentMethod'])->name('payment-method');

        Route::group([
            'prefix' => 'blog',
            'as' => 'blog.',
        ], function () {
            Route::get('/', [MainController::class, 'blog'])->name('index');
            Route::get('/{post:slug_title}', [MainController::class, 'showBlog'])->name('show');
        });

        Route::get('/keranjang', [EcommerceController::class, 'cart'])->name('cart');
        Route::group([
            'middleware' => 'validate_order_token',
        ], function () {
            Route::get('/checkout', [EcommerceController::class, 'checkout'])->name('checkout');
            Route::group([
                'prefix' => 'pembayaran',
                'as' => 'payment.',
            ], function () {
                Route::get('/sukses/{order:order_code}', [EcommerceController::class, 'successPayment'])->name('success');
                Route::get('/gagal/{order:order_code}', [EcommerceController::class, 'failedPayment'])->name('failed');
            });
        });

        Route::group([
            'prefix' => 'kelas',
            'as' => 'course.',
        ], function () {
            Route::get('/', [CourseController::class, 'course'])->name('index');
            Route::get('/kategori/{category}', [CourseController::class, 'course'])->name('category');
            Route::get('/detail/{course}', [CourseController::class, 'showCourse'])->name('show-course');

            Route::group([
                'middleware' => ['auth:customer', 'verified', 'validate_course_progress'],
            ], function () {
                Route::get('/detail/{course}/materi/{lesson}', [CourseController::class, 'showLesson'])->name('show-lesson');
            });
        });

        Route::get('/accomplishment/verify/{certificate?}', [CourseController::class, 'verifyCertificate'])->name('accomplishment.verify');

        Route::group([
            'middleware' => ['validate_course_certificate', 'auth:customer', 'verified'],
        ], function () {
            Route::get('/accomplishment/certificate/{certificate_id}', [CourseController::class, 'generateCertificate'])->name('accomplishment.certificate');
        });
    });
});
