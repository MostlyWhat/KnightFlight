<?php

use App\Http\Controllers\Dashboard\BrowseController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MerchController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/browse', [BrowseController::class, 'index'])
        ->name('dashboard.browse');

    Route::get('/dashboard/merch', [MerchController::class, 'index'])
        ->name('dashboard.merch');
});
