<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Customer;
use Workbench\App\Models\User;

class LoginAsExistingUserTest extends TestCase
{
    #[Test]
    public function it_authenticates_an_existing_user(): void
    {
        $user = User::factory()->create();

        $this
            ->post(route('quick-login.as-existing-user'), ['selected_model' => $user->id])
            ->assertValid()
            ->assertRedirect(config('quick-login.redirect_to'));

        $this->assertAuthenticatedAs($user);
    }

    // With custom config values

    #[Test]
    public function it_prevents_authentication_when_using_a_custom_model_with_the_wrong_keys(): void
    {
        // Passing wrong key on purpose, to make it fail
        $this->usesCustomModelConvention();

        Customer::factory()->create();

        $this->post(route('quick-login.as-existing-user'), ['selected_model' => 'invalid']);

        $this->assertGuest();
    }

    #[Test]
    public function it_authenticates_using_an_existing_user_with_custom_keys(): void
    {
        $this->usesCustomModelConvention();

        $customer = Customer::factory()->create();

        $this->post(route('quick-login.as-existing-user'), ['selected_model' => $customer->getKey()])
            ->assertValid();

        $this->assertAuthenticatedAs($customer, 'customer');
    }

    // With custom config parameters

    #[Test]
    public function it_authenticates_an_existing_user_using_custom_parameters(): void
    {
        $customer = Customer::factory()->create();

        $this->post(route('quick-login.as-existing-user'), [
            'selected_model' => $customer->getKey(),
            'model' => Customer::class,
            'guard' => 'customer',
            'redirect_to' => 'custom'
        ])->assertRedirect('custom');

        $this->assertAuthenticatedAs($customer, 'customer');
    }
}
