<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Js;
use Illuminate\Validation\Rule;

class QuickLoginController
{
    public function loginAs(Request $request): RedirectResponse
    {
        // Check target class existance

        if (! class_exists($model = config('quick-login.model'))) {
            throw new DomainException($model);
        }

        // Validation

        $validated = $request->validate(
            rules: [
                'selected-model' => [
                    'required',
                    Rule::exists($model, $key = config('quick-login.primary_key'))
            ]],
            messages: [
                'selected-model.exists' => "User with primary key [{$key}] not found."
            ]);

        // Login attempt

        $modelInstance = $model::findOrFail($validated['selected-model']);

        Auth::guard($request->post('guard') ?? config('quick-login.guard'))->login($modelInstance);

        return redirect($request->post('redirect_to') ?? config('quick-login.redirect_to'));
    }

    public function createUser(Request $request): RedirectResponse
    {
        $model = $request->post('model') ?? config('quick-login.model');

        if (! class_exists($model)) {
            throw new DomainException($model);
        }

        $modelFactory = $model::factory();

        foreach ($request->post('factory_states') ?? [] as $state) {
            $modelFactory = $modelFactory->$state();
        }

        $modelAttributes = json_decode($request->post('model_attributes'), true);

        $modelInstance = $modelFactory->create($modelAttributes);

        Auth::guard($request->post('guard') ?? config('quick-login.guard'))->login($modelInstance);

        return redirect($request->post('redirect_to') ?? config('quick-login.redirect_to'));
    }
}
