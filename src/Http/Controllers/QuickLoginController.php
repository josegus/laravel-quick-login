<?php

namespace GustavoVasquez\LaravelQuickLogin\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuickLoginController
{
    public function loginAs(Request $request): RedirectResponse
    {
        $model = config('quick-login.model')::findOrFail($request->post('model_id'));

        Auth::login($model, true);

        return redirect(config('quick-login.redirect_url'));
    }

    public function createUser(Request $request): RedirectResponse
    {
        $model = config('quick-login.model')::factory()->create();

        Auth::login($model, true);

        return redirect(config('quick-login.redirect_url'));
    }
}
