<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests\Factories;

use GustavoVasquez\LaravelQuickLogin\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->email(),
            'password' => bcrypt('secret'),
        ];
    }
}
