<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use GustavoVasquez\LaravelQuickLogin\LaravelQuickLoginServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;

abstract class TestCase extends Orchestra
{
    use WithWorkbench;
    use RefreshDatabase;
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(function ($factory) {
            $factoryBasename = class_basename($factory);

            return "Database\Factories\\$factoryBasename".'Factory';
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelQuickLoginServiceProvider::class,
        ];
    }

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

            //$config->set('quick-login.model', \Workbench\App\Models\User::class);
        });
    }
}
