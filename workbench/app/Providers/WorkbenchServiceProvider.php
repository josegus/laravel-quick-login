<?php

namespace Workbench\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Workbench\App\Models\Customer;
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
        // Resolve factories for models in \Workbench\App\Models
        \Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(function ($factory) {
            $factoryBasename = class_basename($factory);

            return "Workbench\\Database\Factories\\$factoryBasename".'Factory';
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::component('app-layout', AppLayout::class);
        Blade::component('guest-layout', GuestLayout::class);

        // Set user model
        $this->app['config']->set('quick-login.model', Customer::class);

        $this->replaceConfigRecursivelyFrom(workbench_path('config/auth.php'), 'auth');
    }
}
