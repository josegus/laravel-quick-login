<?php

namespace GustavoVasquez\LaravelQuickLogin;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use GustavoVasquez\LaravelQuickLogin\Commands\LaravelQuickLoginCommand;

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
            ->hasViews()
            ->hasMigration('create_laravel_quick_login_table')
            ->hasCommand(LaravelQuickLoginCommand::class);
    }
}
