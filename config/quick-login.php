<?php

// config for GustavoVasquez/LaravelQuickLogin
return [
    'environments' => explode(',', env('QUICK_LOGIN_ENVIRONMENTS', 'local')),

    'model' => \App\Models\User::class,

    'model_primary_key' => 'id',

    'model_displayed_attribute' => 'email',

    'redirect_to' => env('QUICK_LOGIN_REDIRECT_TO', 'dashboard'),
];
