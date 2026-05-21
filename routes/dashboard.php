<?php

use App\Http\Controllers\Dashboard\BrowseController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MerchController;
use App\Http\Controllers\Dashboard\OrdersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/browse', [BrowseController::class, 'index'])
        ->name('dashboard.browse');

    Route::get('/dashboard/merch', [MerchController::class, 'index'])
        ->name('dashboard.merch');

    Route::post('/dashboard/merch', [MerchController::class, 'store'])
        ->name('dashboard.merch.store');

    Route::get('/dashboard/receipt/{order}', [MerchController::class, 'receipt'])
        ->name('dashboard.receipt.show');

    Route::get('/dashboard/orders', [OrdersController::class, 'index'])
        ->name('dashboard.orders');
});
