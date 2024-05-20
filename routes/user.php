<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Auth\AuthenticatedController;
use App\Http\Controllers\Api\User\Auth\RegisteredUserController;
use App\Http\Controllers\Api\User\Auth\VerifyPhoneController;
use App\Http\Controllers\Api\User\EateryController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\ProfileController;


Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

    Route::controller(AuthenticatedController::class)->group(function () {
        Route::post('/login', 'store')->name('login');

        Route::post('/logout', 'destroy')->name('logout');
    });

    Route::post('verify-phone', VerifyPhoneController::class)->middleware(['auth:api'])->name('verification.verify');
});


Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('profile', ProfileController::class)
        ->only('show', 'destroy');

    Route::middleware(['verified.phone'])->group(function () {
        Route::apiResource('eatery', EateryController::class)
            ->only('index', 'show');

        Route::get('orders', [OrderController::class, 'index'])->name('order.index');
        Route::apiResource('product.order', OrderController::class)->only('store');
    });
});
