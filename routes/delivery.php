<?php

use App\Http\Controllers\Api\Delivery\Auth\DeliveryAuthenticatedController;
use App\Http\Controllers\Api\Delivery\OrderDeliveryController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:delivery'])->group(function () {
    Route::apiResource('order_delivery', OrderDeliveryController::class)
        ->parameter('order_delivery', 'order')
        ->except('store', 'destroy');
});


Route::prefix('delivery_auth')->group(function () {
    Route::controller(DeliveryAuthenticatedController::class)->group(function () {
        Route::post('/login', 'store')->name('login');

        Route::post('/logout', 'destroy')->name('logout');
    });
});
