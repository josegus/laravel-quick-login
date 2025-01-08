<?php

use GustavoVasquez\LaravelQuickLogin\Http\Controllers\QuickLoginAsExistingUserController;
use GustavoVasquez\LaravelQuickLogin\Http\Controllers\QuickLoginAsNewUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'web'])->group(function () {
    Route::post('quick-login/login-as', QuickLoginAsExistingUserController::class)->name('quick-login.as-existing-user');
    Route::post('quick-login/create-user', QuickLoginAsNewUserController::class)->name('quick-login.as-new-user');
});
