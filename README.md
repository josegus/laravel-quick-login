# Laravel Quick Login

[![Latest Version on Packagist](https://img.shields.io/packagist/v/josegus/laravel-quick-login.svg?style=flat-square)](https://packagist.org/packages/josegus/laravel-quick-login)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/josegus/laravel-quick-login/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/josegus/laravel-quick-login/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/josegus/laravel-quick-login/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/josegus/laravel-quick-login/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/josegus/laravel-quick-login.svg?style=flat-square)](https://packagist.org/packages/josegus/laravel-quick-login)

A simple Laravel component that enables quick login functionality for development environments.

In short, it includes a blade component that you can include in your login view to:
- create new users and automatically log in as the created user, with one click
- select an existing user to log in, with one click

## Installation

You can install the package via composer:

```bash
composer require josegus/laravel-quick-login
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="quick-login-config"
```


This will create the `config/quick-login.php` file with the following options:


```php
return [
    'model' => \App\Models\User::class,

    'displayed_attribute' => 'email',

    'redirect_to' => env('QUICK_LOGIN_REDIRECT_TO', 'dashboard'),
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="quick-login-views"
```

## Usage

### Blade Component

The package includes a Blade component that you can use in any view:

```blade
<x-josegus::quick-login-form />
```

The above code will use Laravel's default authentication model (`App\Models\User`) and guard (`web`).

### Using a different guard

If your app uses a different guard, pass it as a parameter to the component:

```blade
<x-josegus::quick-login-form guard="customer" />
```

### Using factory states

To create new users, the package will use the factory defined in your auth model, so make sure your auth model uses the `HasFactory` trait. You can pass an array of factory states that will be applied when the package creates new users:

```blade
<x-josegus::quick-login-form
    :factory-states="['isForeign', 'withCompany']"
/>
```

### Using extra model attributes

Alternatively, you can pass an array of properties that will be applied when the package creates new users:

```blade
<x-josegus::quick-login-form
    :model-attributes="['is_foreign' => true, 'company_name' => 'Laravel']"
/>
```

## Advanced Customization

### Change the Displayed Attribute

By default, the user's email is displayed. You can change this in the configuration:

```php
// config/quick-login.php
return [
    'displayed_attribute' => 'username',
];
```

## Testing

```bash
composer test
```

## License

This package is open-source software licensed under the MIT license.

## Security

⚠️ **Warning**: This package is designed for development environments only. It is not recommended for use in production.
