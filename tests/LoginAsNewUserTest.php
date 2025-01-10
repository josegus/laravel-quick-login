<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Customer;
use Workbench\App\Models\User;

class LoginAsNewUserTest extends TestCase
{
    #[Test]
    public function it_creates_and_authenticates_a_new_user(): void
    {
        $this->post(route('quick-login.as-new-user'))
            ->assertValid()
            ->assertRedirect(config('quick-login.redirect_to'));

        $this->assertAuthenticated();

        $this->assertDatabaseCount(User::class, 1);
    }

    #[Test]
    public function it_creates_and_authenticates_a_new_user_with_custom_parameters(): void
    {
        $this->post(route('quick-login.as-new-user'), [
            'model' => Customer::class,
            'guard' => 'customer',
            'redirect_to' => 'custom'
        ])->assertValid()
        ->assertRedirect('custom');

        $this->assertAuthenticated('customer');

        $this->assertDatabaseCount(Customer::class, 1);
    }

    #[Test]
    public function it_accepts_an_array_of_factory_states_as_part_of_the_custom_parameters(): void
    {
        $this->post(route('quick-login.as-new-user'), [
            'factory_states' => ['isForeign', 'withCompany']
        ])->assertValid();

        $this->assertAuthenticated();

        $this->assertTrue(User::whereNotNull([
            'is_foreign',
            'country',
            'city',
            'company_name',
            'company_address',
        ])->exists());
    }

    #[Test]
    public function it_accepts_an_array_of_model_attributes_as_part_of_the_custom_parameters(): void
    {
        $this->post(route('quick-login.as-new-user'), [
            'model_attributes' => json_encode(['is_foreign' => true, 'company_name' => 'Laravel'])
        ])->assertValid();

        $this->assertAuthenticated();

        $this->assertDatabaseHas(User::class, [
            'is_foreign' => true,
            'company_name' => 'Laravel'
        ]);
    }
}
