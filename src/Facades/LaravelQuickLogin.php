<?php

namespace GustavoVasquez\LaravelQuickLogin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GustavoVasquez\LaravelQuickLogin\LaravelQuickLogin
 */
class LaravelQuickLogin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \GustavoVasquez\LaravelQuickLogin\LaravelQuickLogin::class;
    }
}
