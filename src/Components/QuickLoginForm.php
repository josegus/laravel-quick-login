<?php

namespace GustavoVasquez\LaravelQuickLogin\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;
use PHPUnit\Framework\MockObject\Generator\UnknownClassException;

class QuickLoginForm extends Component
{
    public ?Collection $users = null;
    public ?string $primaryKey = null;
    public ?string $displayedAttribute = null;

    public function __construct()
    {
        if (! class_exists($modelClass = config('quick-login.model'))) {
            throw new UnknownClassException($modelClass);
        }

        $this->primaryKey = config('quick-login.model_primary_key');

        $this->displayedAttribute = config('quick-login.model_displayed_attribute');

        $this->users = $modelClass::select([$this->primaryKey, $this->displayedAttribute])->get();
    }

    public function render(): View
    {
        return view('josegus::components.quick-login-form');
    }
}
