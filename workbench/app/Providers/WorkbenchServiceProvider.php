<?php

namespace Workbench\App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Workbench\App\Models\User;

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
        // Set user model
        $this->app['config']->set('quick-login.model', User::class);
    }
}
