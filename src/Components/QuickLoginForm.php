<?php

namespace GustavoVasquez\LaravelQuickLogin\Components;

use DomainException;
use Illuminate\View\Component;
use Illuminate\View\View;

class QuickLoginForm extends Component
{
    public ?string $model = null;
    public ?string $guard = null;
    public ?string $primaryKey = null;
    public ?string $displayedAttribute = null;
    public ?string $redirectTo = null;

    public function __construct(
        ?string $model = null,
        ?string $guard = null,
        ?string $primaryKey = null,
        ?string $displayedAttribute = null,
        ?string $redirectTo = null
    ) {
        if (! class_exists($this->model = $model ?? config('quick-login.model'))) {
            throw new DomainException($this->model);
        }

        $this->guard = $guard ?? config('quick-login.guard');

        $this->primaryKey = $primaryKey ?? config('quick-login.primary_key');

        $this->displayedAttribute = $displayedAttribute ?? config('quick-login.displayed_attribute');

        $this->redirectTo = $redirectTo ?? config('quick-login.redirect_to');
    }

    public function render(): View
    {
        return view('josegus::components.quick-login-form', [
            'users' => $this->model::select([$this->primaryKey, $this->displayedAttribute])->get()
        ]);
    }

    public function shouldRender(): bool
    {
        return in_array(config('app.env'), config('quick-login.environments'));
    }
}
