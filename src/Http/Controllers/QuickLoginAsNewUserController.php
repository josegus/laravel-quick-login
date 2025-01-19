<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use DomainException;
use GustavoVasquez\LaravelQuickLogin\Helpers\QuickLogin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuickLoginAsNewUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $quick = new QuickLogin($request);

        $model = $quick->model();

        if (! class_exists($model)) {
            throw new DomainException($model);
        }

        $modelFactory = $model::factory();

        foreach ($quick->factoryStates() as $state) {
            $modelFactory = $modelFactory->$state();
        }

        $modelInstance = $modelFactory->create($quick->modelAttributes());

        Auth::guard($quick->guard())->login($modelInstance);

        return redirect($quick->redirectTo());
    }
}
