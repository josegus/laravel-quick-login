<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use GustavoVasquez\LaravelQuickLogin\Helpers\QuickLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuickLoginAsExistingUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $quick = new QuickLogin($request);

        // Check target class existance
        $model = $quick->model();

        if (! class_exists($model)) {
            throw new DomainException($model);
        }

        // Login attempt
        $modelInstance = $model::findOrFail($quick->selectedModelKey());

        Auth::guard($quick->guard())->login($modelInstance);

        return redirect($quick->redirectTo());
    }
}
