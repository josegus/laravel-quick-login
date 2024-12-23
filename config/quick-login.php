<?php

// config for GustavoVasquez/LaravelQuickLogin
return [
    'model' => \App\Models\User::class,

    'redirect_url' => env('QUICK_LOGIN_REDIRECT_URL', 'dashboard'),
];
