<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests\Models;

use GustavoVasquez\LaravelQuickLogin\Tests\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['email'];

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
