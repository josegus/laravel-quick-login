<?php

namespace Workbench\App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Orchestra\Workbench\Http\Requests\Auth\LoginRequest;

class LoginController
{
    public function create(): View
    {
        return view('admin.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/admin/dashboard');
    }
}
