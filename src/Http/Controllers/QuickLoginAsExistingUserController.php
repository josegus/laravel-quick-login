<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuickLoginAsExistingUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        // Check target class existance
        $model = $request->post('model') ?? config('quick-login.model');

        if (! class_exists($model)) {
            throw new DomainException($model);
        }

        // Login attempt
        $modelInstance = $model::findOrFail($request->post('selected_model'));

        Auth::guard($request->post('guard') ?? config('quick-login.guard'))->login($modelInstance);

        return redirect($request->post('redirect_to') ?? config('quick-login.redirect_to'));
    }
}
