<?php

return [
    'model' => \App\Models\User::class,

    'displayed_attribute' => 'email',

    'redirect_to' => env('QUICK_LOGIN_REDIRECT_TO', 'dashboard'),
];
