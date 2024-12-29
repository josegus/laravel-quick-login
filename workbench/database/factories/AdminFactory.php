<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Workbench\App\Models\Admin;

/**
 * @template TModel of \Workbench\App\Models\Admin
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class AdminFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
