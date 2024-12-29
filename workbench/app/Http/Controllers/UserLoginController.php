<?php

namespace Workbench\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Orchestra\Workbench\Http\Requests\Auth\LoginRequest;

class UserLoginController
{
    public function create(): View
    {
        return view('user-login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        dd('UserLoginController@store');
        /* if (! Auth::guard('customer')->attempt($request->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        } */

        $request->session()->regenerate();

        return redirect('/dashboard');
    }
}
