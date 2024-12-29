<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class QuickLoginController
{
    public function loginAs(Request $request): RedirectResponse
    {
        // Check target class existance

        if (! class_exists($modelClass = config('quick-login.model'))) {
            throw new DomainException($modelClass);
        }

        // Validation

        $validated = validator(
            data: $request->only('model'),
            rules: [
                'model' => [
                    'required',
                    Rule::exists($modelClass, $key = config('quick-login.model_primary_key'))
            ]],
            messages: [
                'model.exists' => "User with primary key [{$key}] not found."
            ]
        )->validate();

        // Login attempt

        $modelInstance = $modelClass::findOrFail($validated['model']);

        Auth::login($modelInstance);

        return redirect($request->post('redirect_to') ?? config('quick-login.redirect_to'));
    }

    public function createUser(Request $request): RedirectResponse
    {
        $modelClass = $request->post('model_class') ?? config('quick-login.model');

        if (! class_exists($modelClass)) {
            throw new DomainException($modelClass);
        }

        $modelInstance = $modelClass::factory()->create();

        Auth::login($modelInstance);

        return redirect($request->post('redirect_to') ?? config('quick-login.redirect_to'));
    }
}
