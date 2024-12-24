<?php

namespace GustavoVasquez\LaravelQuickLogin;

use GustavoVasquez\LaravelQuickLogin\Components\QuickLoginForm;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelQuickLoginServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-quick-login')
            ->hasConfigFile()
            ->hasViews('josegus')
            ->hasViewComponents('josegus', QuickLoginForm::class)
            ->hasRoute('quick-login');
    }
}
