<?php

namespace GustavoVasquez\LaravelQuickLogin;

use GustavoVasquez\LaravelQuickLogin\Components\QuickLoginForm;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelQuickLoginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/quick-login.php', 'quick-login'
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/quick-login.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'josegus');
        $this->configurePublications();

        Blade::componentNamespace('GustavoVasquez\\LaravelQuickLogin\\Components', 'josegus');
        Blade::component('quick-login-form', QuickLoginForm::class);
    }

    private function configurePublications(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/quick-login.php' => config_path('quick-login.php'),
        ], 'quick-login-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/quick-login'),
        ], 'quick-login-views');

        $this->publishes([
            __DIR__.'/../routes/quick-login.php' => base_path('routes/quick-login.php'),
        ], 'quick-login-routes');
    }
}
