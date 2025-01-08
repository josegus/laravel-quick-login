<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Customer;
use Workbench\App\Models\User;

class LoginTest extends TestCase
{
    #[Test]
    public function it_authenticates_an_existing_user(): void
    {
        $user = User::factory()->create();

        $this
            ->post(route('quick-login.as-existing-user'), ['selected-model' => $user->id])
            ->assertValid();

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function it_creates_and_authenticates_a_new_user(): void
    {
        $this->post(route('quick-login.as-new-user'));

        $this->assertAuthenticated();
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

    #[Test]
    public function it_validates_and_prevents_authentication_when_using_a_custom_model_with_the_wrong_keys(): void
    {
        // Passing wrong key on purpose, to make it fail
        $this->usesCustomModelConvention(['primary_key' => $key = 'id']);

        $customer = Customer::factory()->create();

        $this->post(route('quick-login.as-existing-user'), ['selected-model' => $customer->uuid])
            ->assertInvalid([
                'selected-model' => "User with primary key [{$key}] not found."
            ]);

        $this->assertGuest();
    }

    #[Test]
    public function it_authenticates_using_an_existing_user_with_custom_keys(): void
    {
        $this->usesCustomModelConvention();

        $customer = Customer::factory()->create();

        $this->post(route('quick-login.as-existing-user'), ['selected-model' => $customer->uuid])
            ->assertValid();

        $this->assertAuthenticatedAs($customer, 'customer');
    }
}
