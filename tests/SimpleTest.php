<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests;

use GustavoVasquez\LaravelQuickLogin\Components\QuickLoginForm;
use GustavoVasquez\LaravelQuickLogin\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Orchestra\Testbench\workbench_path;

class SimpleTest extends TestCase
{
    /** @test */
    public function it_renders_component_quick_login_form(): void
    {
        $this->migrate();
        $this->component(QuickLoginForm::class)->assertSee('Quick Login');
    }
}
