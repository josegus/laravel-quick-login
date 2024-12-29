<?php

namespace GustavoVasquez\LaravelQuickLogin\Components;

use DomainException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class QuickLoginForm extends Component
{
    public ?string $modelClass = null;
    public ?string $primaryKey = null;
    public ?string $displayedAttribute = null;
    public ?string $redirectTo = null;
    public ?Collection $users = null;

    public function __construct(?string $modelClass = null, ?string $primaryKey = null, ?string $displayedAttribute = null, ?string $redirectTo = null)
    {
        if (! class_exists($this->modelClass = $modelClass ?? config('quick-login.model'))) {
            throw new DomainException($this->modelClass);
        }

        $this->primaryKey = $primaryKey ?? config('quick-login.model_primary_key');

        $this->displayedAttribute = $displayedAttribute ?? config('quick-login.model_displayed_attribute');

        $this->redirectTo = $redirectTo ?? config('quick-login.redirect_to');

        $this->users = $this->modelClass::select([$this->primaryKey, $this->displayedAttribute])->get();
    }

    public function render(): View
    {
        return view('josegus::components.quick-login-form');
    }

    public function shouldRender(): bool
    {
        return in_array(config('app.env'), config('quick-login.environments'));
    }
}
