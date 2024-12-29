<?php

namespace Workbench\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Orchestra\Workbench\Http\Requests\Auth\LoginRequest;

class CustomerLoginController
{
    public function create(): View
    {
        return view('customer-login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        dd('CustomerLoginController@store');

        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/customer/dashboard');
    }
}
