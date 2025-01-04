<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Workbench\App\Models\User;

/**
 * @template TModel of \Workbench\App\Models\User
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class UserFactory extends Factory
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
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    // states

    public function isForeign(): self
    {
        return $this->state([
            'is_foreign' => true,
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
        ]);
    }

    public function withCompany(): self
    {
        return $this->state([
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->address(),
        ]);
    }
}
