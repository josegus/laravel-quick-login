<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class QuickLoginAsExistingUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        // Check target class existance
        $model = $request->post('model') ?? config('quick-login.model');

        if (! class_exists($model)) {
            throw new DomainException($model);
        }

        // Validation

        $validated = $request->validate(
            rules: [
                'selected_model' => [
                    'required',
                    Rule::exists($model, $key = $request->post('primary_key') ?? config('quick-login.primary_key'))
            ]],
            messages: [
                'selected_model.exists' => "User with primary key [{$key}] not found."
            ]);

        // Login attempt

        $modelInstance = $model::findOrFail($validated['selected_model']);

        Auth::guard($request->post('guard') ?? config('quick-login.guard'))->login($modelInstance);

        return redirect($request->post('redirect_to') ?? config('quick-login.redirect_to'));
    }
}
