<?php

use Illuminate\Support\Facades\Route;
use Workbench\App\Http\Controllers\CustomerDashboardController;
use Workbench\App\Http\Controllers\CustomerLoginController;
use Workbench\App\Http\Controllers\LogoutController;
use Workbench\App\Http\Controllers\UserDashboardController;
use Workbench\App\Http\Controllers\UserLoginController;

Route::middleware('guest')->group(function () {
    // User
    Route::get('login', [UserLoginController::class, 'create']);
    Route::post('login', [UserLoginController::class, 'store'])->name('login');

    // Customer
    Route::get('customers/login', [CustomerLoginController::class, 'create']);
    Route::post('customers/login', [CustomerLoginController::class, 'store'])->name('customer.login');
});

Route::middleware('auth:web,customer')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');

    // User
    Route::get('dashboard', UserDashboardController::class);

    // Customer
    Route::get('customers/dashboard', CustomerDashboardController::class);
});

// dev

Route::get('config', function () {
    return config('auth');
});
