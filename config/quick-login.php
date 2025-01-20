<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Model
    |--------------------------------------------------------------------------
    |
    | This value defines which model class should be used for authentication.
    | By default it uses the User model.
    */
    'model' => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Display Attribute
    |--------------------------------------------------------------------------
    |
    | The attribute that should be displayed in the quick login interface.
    | Typically this would be 'email' or 'username'.
    */
    'displayed_attribute' => 'email',

    /*
    |--------------------------------------------------------------------------
    | Redirect Path
    |--------------------------------------------------------------------------
    |
    | After successful quick login, users will be redirected to this path.
    | Can be configured via QUICK_LOGIN_REDIRECT_TO environment variable.
    | Defaults to 'dashboard' if not specified.
    */
    'redirect_to' => env('QUICK_LOGIN_REDIRECT_TO', 'dashboard'),
];
