<?php

namespace GustavoVasquez\LaravelQuickLogin\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Form extends Component
{
    public ?Collection $users = null;

    public function __construct()
    {
        $this->users = config('quick-login.model')::all();
    }

    public function render(): View
    {
        return view('josegus::components.form');
    }
}
