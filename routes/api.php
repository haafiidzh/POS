<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RetributionController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AttendanceController;



Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'editUserData']);
        Route::post('changePassword', [AuthController::class, 'changePassword']);
        Route::post('user/update/{id}', [AuthController::class, 'updatePartner']);

    

        //Produk
        Route::get('produk', [ProductController::class, 'index']);
        Route::delete('produk/{id}', [ProductController::class, 'destroy']);
        Route::post('produk/{id}/update', [ProductController::class, 'update']);
        Route::get('produk/{id}', [ProductController::class, 'edit']);
        Route::post('produk/tambah', [ProductController::class, 'store']);
        Route::post('checkout', [ProductController::class, 'checkout']);



        //Kategori
        Route::get('kategori', [CategoryController::class, 'index']);
        Route::get('retributions', [CategoryController::class, 'indexRetribution']);
        Route::get('retributions/{id}', [CategoryController::class, 'retribution']);



        Route::get('history/retributions', [RetributionController::class, 'index']);
        Route::post('history/add/retributions', [RetributionController::class, 'store']);




        Route::post('kategori', [CategoryController::class, 'store']);
        Route::put('kategori/{id}', [CategoryController::class, 'update']);
        Route::delete('kategori/{id}', [CategoryController::class, 'destroy']);
        Route::get('kategori/{id}', [CategoryController::class, 'edit']);


        //Sales
        Route::get('sales', [SalesController::class, 'index']);
        Route::get('sales/{id}', [SalesController::class, 'show']);


         //Sales
         Route::get('attendance', [AttendanceController::class, 'index']);
         Route::get('check/attendance', [AttendanceController::class, 'checkStatus']);
         Route::post('attendance/in', [AttendanceController::class, 'submitCheckIn']);
         Route::post('attendance/out', [AttendanceController::class, 'submitCheckOut']); 

         //Report
         Route::get('reports', [ReportController::class, 'index']);
         Route::get('reports/month', [ReportController::class, 'indexMonth']);
         Route::get('report/{id}', [ReportController::class, 'show']);
    });
});
