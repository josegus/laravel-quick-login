<?php

use Illuminate\Support\Facades\Route;
use Workbench\App\Http\Controllers\Admin\LoginController as AdminAuthController;
use Workbench\App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Workbench\App\Http\Controllers\Customer\LoginController as CustomerAuthController;
use Workbench\App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use Workbench\App\Http\Controllers\LogoutController;

Route::middleware('guest')->group(function () {
    // Customer
    Route::get('login', [CustomerAuthController::class, 'create']);
    Route::post('login', [CustomerAuthController::class, 'store'])->name('login');

    // Admin
    Route::get('admin/login', [AdminAuthController::class, 'create']);
    Route::post('admin/login', [AdminAuthController::class, 'store'])->name('admin.login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');

    // Customer
    Route::get('dashboard', CustomerDashboardController::class);

    // Admin
    Route::get('admin/dashboard', AdminDashboardController::class);
});
