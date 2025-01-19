<?php

namespace GustavoVasquez\LaravelQuickLogin\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class QuickLoginForm extends Component
{
    public ?string $model = null;
    public ?string $guard = null;
    public ?string $displayedAttribute = null;
    public ?string $redirectTo = null;
    public ?array $factoryStates = null;
    public ?array $modelAttributes = null;

    public function __construct(
        ?string $model = null,
        ?string $guard = null,
        ?string $displayedAttribute = null,
        ?string $redirectTo = null,
        ?array $factoryStates = null,
        ?array $modelAttributes = null
    ) {
        $this->model = $model ?? config('quick-login.model') ?? config('auth.providers.users.model');
        $this->guard = $guard;
        $this->displayedAttribute = $displayedAttribute ?? config('quick-login.displayed_attribute');
        $this->redirectTo = $redirectTo;
        $this->factoryStates = $factoryStates;
        $this->modelAttributes = $modelAttributes;
    }

    public function render(): View
    {
        return view('josegus::components.quick-login-form', [
            'users' => $this->model::select([(new $this->model)->getKeyName(), $this->displayedAttribute])->get()
        ]);
    }

    public function shouldRender(): bool
    {
        return in_array(config('app.env'), config('quick-login.environments'));
    }
}
