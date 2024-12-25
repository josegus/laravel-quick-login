<?php

namespace Workbench\App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Factory::guessFactoryNamesUsing(function ($factory) {
        //     $factoryBasename = class_basename($factory);

        //     return "Database\Factories\\$factoryBasename".'Factory';
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
