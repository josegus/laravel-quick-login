<?php

return [
    'environments' => explode(',', env('QUICK_LOGIN_ENVIRONMENTS', 'local')),

    'model' => \App\Models\User::class,

    'guard' => 'web',

    'primary_key' => 'id',

    'displayed_attribute' => 'email',

    'redirect_to' => env('QUICK_LOGIN_REDIRECT_TO', 'dashboard'),
];
