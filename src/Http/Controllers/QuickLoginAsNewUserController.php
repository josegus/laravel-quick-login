<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuickLoginAsNewUserController
{
    public function __invoke(Request $request): RedirectResponse
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
