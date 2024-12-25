<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use GustavoVasquez\LaravelQuickLogin\LaravelQuickLoginServiceProvider;
use GustavoVasquez\LaravelQuickLogin\Tests\Models\User;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

        $this->migrate();
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

            $config->set('quick-login.model', User::class);
        });
    }

    protected function migrate(): void
    {
        $migrations = [
            Migrations\UsersMigration::class,
        ];

        foreach ($migrations as $migration) {
            (new $migration)->up();
        }
    }
}
