<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use Workbench\App\Models\User;

//use GustavoVasquez\LaravelQuickLogin\Tests\Models\User;

class LoginTest extends TestCase
{
    /** @test */
    public function is_empty(): void
    {
        $this->assertDatabaseEmpty('users');
    }

    /** @test */
    public function it_can_login_using_an_existing_user(): void
    {
        $user = User::factory()->create();

        $this->post(route('quick-login.login-as'), ['model' => $user->id]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_creates_a_new_user_and_login_as_it(): void
    {
        $this->post(route('quick-login.create-user'));

        $this->assertAuthenticated('web');
    }
}
