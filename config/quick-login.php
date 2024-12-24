<?php

// config for GustavoVasquez/LaravelQuickLogin
return [
    'model' => \App\Models\User::class,

    'model_primary_key' => 'id',

    'model_displayed_attribute' => 'email',

    'redirect_url' => env('QUICK_LOGIN_REDIRECT_URL', 'dashboard'),
];
