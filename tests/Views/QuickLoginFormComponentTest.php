<?php

namespace GustavoVasquez\LaravelQuickLogin\Tests\Views;

use GustavoVasquez\LaravelQuickLogin\Components\QuickLoginForm;
use GustavoVasquez\LaravelQuickLogin\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Customer;
use Workbench\App\Models\User;

class QuickLoginFormComponentTest extends TestCase
{
    #[Test]
    public function component_default_properties_are_injected_in_the_rendered_view(): void
    {
        $this->component(QuickLoginForm::class)
            ->assertSeeInOrder([
                // login as
                '<input type="text" class="hidden" name="model" value="Workbench\\App\\Models\\User">',
                '<input type="text" class="hidden" name="guard" value="">',
                '<input type="text" class="hidden" name="redirect_to" value="">',
                // create user
                '<input type="text" class="hidden" name="model" value="Workbench\\App\\Models\\User">',
                '<input type="text" class="hidden" name="guard" value="">',
                '<input type="text" class="hidden" name="redirect_to" value="">',
            ], false);
    }

    #[Test]
    public function component_custom_properties_are_injected_in_the_rendered_view(): void
    {
        $this->component(QuickLoginForm::class, [
            'model' => 'Workbench\\App\\Models\\Customer',
            'guard' => 'custom',
            'redirectTo' => 'other',
        ])
            ->assertSeeInOrder([
                // login as
                '<input type="text" class="hidden" name="model" value="Workbench\\App\\Models\\Customer">',
                '<input type="text" class="hidden" name="guard" value="custom">',
                '<input type="text" class="hidden" name="redirect_to" value="other">',
                // create user
                '<input type="text" class="hidden" name="model" value="Workbench\\App\\Models\\Customer">',
                '<input type="text" class="hidden" name="guard" value="custom">',
                '<input type="text" class="hidden" name="redirect_to" value="other">',
            ], false);
    }

    #[Test]
    public function it_displays_users_with_default_primary_key_and_displayed_attribute(): void
    {
        [$user1, $user2] = User::factory()->count(2)->create();

        $this->component(QuickLoginForm::class)
            ->assertSee('<option value="' . $user1->id . '">' . $user1->email . '</option>', false)
            ->assertSee('<option value="' . $user2->id . '">' . $user2->email . '</option>', false);
    }

    #[Test]
    public function it_displays_users_with_custom_primary_key_and_displayed_attribute(): void
    {
        [$customer1, $customer2] = Customer::factory()->count(2)->create();

        $this->component(QuickLoginForm::class, [
            'model' => Customer::class,
            'displayedAttribute' => 'username',
        ])
            ->assertSeeInOrder([
                '<option value="' . $customer1->uuid . '">' . $customer1->username . '</option>',
                '<option value="' . $customer2->uuid . '">' . $customer2->username . '</option>',
            ], false);
    }

    #[Test]
    public function component_accepts_an_array_of_factory_states(): void
    {
        $this->component(QuickLoginForm::class, ['factoryStates' => ['isForeign', 'withCompany']])
            ->assertSee('<input type="text" class="hidden" name="factory_states[]" value="isForeign">', false)
            ->assertSee('<input type="text" class="hidden" name="factory_states[]" value="withCompany">', false);
    }

    #[Test]
    public function component_accepts_an_array_of_model_attributes(): void
    {
        $this->markTestSkipped('Fix encode');

        $this->component(QuickLoginForm::class, [
            'modelAttributes' => $attributes = [
                'is_foreign' => 1,
                'company_name' => fake()->company(),
                'company_address' => fake()->streetAddress()
            ]
        ])
            ->assertSee('<input type="text" class="hidden" name="model_attributes" value="'.json_encode($attributes).'">', false);
    }
}
