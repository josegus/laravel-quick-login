<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use Orchestra\Testbench\Attributes\DefineEnvironment;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Customer;
use Workbench\App\Models\User;

class LoginTest extends TestCase
{
    // using default User with id and email

    protected function usesDefaultModelConvention($app)
    {
        $app['config']->set('quick-login.model', User::class);
    }

    #[Test]
    #[DefineEnvironment('usesDefaultModelConvention')]
    public function it_authenticates_an_existing_user(): void
    {
        $user = User::factory()->create();

        $this
            ->post(route('quick-login.login-as'), ['model' => $user->id])
            ->assertValid();

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    #[DefineEnvironment('usesDefaultModelConvention')]
    public function it_creates_and_authenticates_a_new_user(): void
    {
        $this->post(route('quick-login.create-user'));

        $this->assertAuthenticated();
    }

    // using custom model with different primary & display key

    protected function usesCustomModelConvention($app)
    {
        $app['config']->set('quick-login.model', Customer::class);
        $app['config']->set('quick-login.model_primary_key', 'uuid');
        $app['config']->set('quick-login.model_displayed_attribute', 'username');
        $app['config']->set('auth.guards.web.provider', 'customers');
        $app['config']->set('auth.providers.customers', [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]);
    }

    #[Test]
    #[DefineEnvironment('usesCustomModelConvention')]
    public function it_validates_and_prevents_authentication_when_using_a_custom_model_with_the_wrong_keys(): void
    {
        config(['quick-login.model_primary_key' => $key = 'id']);

        $customer = Customer::factory()->create();

        $this->post(route('quick-login.login-as'), ['model' => $customer->uuid])
            ->assertInvalid([
                'model' => "User with primary key [{$key}] not found."
            ]);

        $this->assertGuest();
    }

    #[Test]
    #[DefineEnvironment('usesCustomModelConvention')]
    public function it_authenticates_using_an_existing_user_with_custom_keys(): void
    {
        $customer = Customer::factory()->create();

        $this->post(route('quick-login.login-as'), ['model' => $customer->uuid])
            ->assertValid();

        $this->assertAuthenticatedAs($customer);
    }
}
