<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\XenditController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'prefix' => 'v1',
    'middleware' => 'xendit_token',
], function () {
    Route::post('/invoice/callback', [XenditController::class, 'invoiceCallback']);
});
