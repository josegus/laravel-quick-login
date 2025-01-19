<?php

namespace GustavoVasquez\LaravelQuickLogin\Helpers;

use Illuminate\Http\Request;

class QuickLogin
{
    public function __construct(public readonly Request $request)
    {
        //
    }

    public function model(): ?string
    {
        return $this->request->post('model') ?? config('quick-login.model') ?? config('auth.providers.users.model');
    }

    public function guard(): ?string
    {
        return $this->request->post('guard');
    }

    public function factoryStates(): array
    {
        return $this->request->post('factory_states') ?? [];
    }

    public function modelAttributes(): ?array
    {
        return json_decode($this->request->post('model_attributes'), true);
    }

    public function redirectTo(): ?string
    {
        return $this->request->post('redirect_to') ?? config('quick-login.redirect_to');
    }

    public function selectedModelKey(): mixed
    {
        return $this->request->post('selected_model');
    }
}
