<?php

namespace Workbench\App\Http\Controllers\Customer;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Orchestra\Workbench\Http\Requests\Auth\LoginRequest;

class LoginController
{
    public function create(): View
    {
        dd(config('auth'));
        return view('customer.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
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
