<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use GustavoVasquez\LaravelQuickLogin\LaravelQuickLoginServiceProvider;
use GustavoVasquez\LaravelQuickLogin\Tests\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelQuickLoginServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('quick-login.model', User::class);
    }

    public function migrate()
    {
        $migrations = [
            Migrations\UsersMigration::class,
        ];

        foreach ($migrations as $migration) {
            (new $migration)->up();
        }
    }
}
