<?php

namespace Workbench\App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Workbench\App\Models\User;
use Workbench\App\View\Components\AppLayout;
use Workbench\App\View\Components\GuestLayout;

use function Orchestra\Testbench\workbench_path;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Resolve factories for models in \Workbench\App\Models
        Factory::guessFactoryNamesUsing(function ($factory) {
            $factoryBasename = class_basename($factory);

            return "Workbench\\Database\Factories\\$factoryBasename".'Factory';
        });

        Blade::component('app-layout', AppLayout::class);
        Blade::component('guest-layout', GuestLayout::class);

        // Set default user model for local testing
        //$this->app['config']->set('quick-login.model', User::class);
        Config::set('quick-login.model', User::class);

        $this->replaceConfigRecursivelyFrom(workbench_path('config/auth.php'), 'auth');
    }
}
