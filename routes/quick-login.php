<?php

use GustavoVasquez\LaravelQuickLogin\Http\Controllers\QuickLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'web'])->group(function () {
    Route::post('/quick-login/login-as', [QuickLoginController::class, 'loginAs'])->name('quick-login.login-as');
    Route::post('/quick-login/create-user', [QuickLoginController::class, 'createUser'])->name('quick-login.create-user');
});
