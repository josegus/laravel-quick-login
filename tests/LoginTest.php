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
            ->post(route('quick-login.login-as'), ['selected-model' => $user->id])
            ->assertValid();

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function it_creates_and_authenticates_a_new_user(): void
    {
        $this->post(route('quick-login.create-user'));

        $this->assertAuthenticated();
    }

    #[Test]
    public function it_validates_and_prevents_authentication_when_using_a_custom_model_with_the_wrong_keys(): void
    {
        // Passing wrong key on purpose, to make it fail
        $this->usesCustomModelConvention(['primary_key' => $key = 'id']);

        $customer = Customer::factory()->create();

        $this->post(route('quick-login.login-as'), ['selected-model' => $customer->uuid])
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

        $this->post(route('quick-login.login-as'), ['selected-model' => $customer->uuid])
            ->assertValid();

        $this->assertAuthenticatedAs($customer, 'customer');
    }
}
