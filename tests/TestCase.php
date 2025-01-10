<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Workbench\App\Models\Customer;

abstract class TestCase extends Orchestra
{
    use WithWorkbench, RefreshDatabase, InteractsWithViews;

    // Environments & Configuraiton hooks

    /**
     * Here we define config options early in the bootstrapping process (between
     * registering service providers and booting service providers).
     *
     * @link https://packages.tools/testbench/the-basic/environment.html#defineenvironment-method
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'testbench');
            $config->set('database.connections.testbench', [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]);
        });
    }

    protected function usesCustomModelConvention(): void
    {
        tap($this->app['config'], function (Repository $config) {
            $config->set('quick-login', [
                'model' => Customer::class,
                'guard' => 'customer',
                'displayed_attribute' => 'username',
                'redirect_to' => 'customers/dashboard',
            ]);
        });
    }
}
