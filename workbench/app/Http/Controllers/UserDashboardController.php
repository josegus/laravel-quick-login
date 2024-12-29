<?php

namespace Workbench\App\Http\Controllers;

use Illuminate\Contracts\View\View;

class UserDashboardController
{
    public function __invoke(): View
    {
        return view('user-dashboard');
    }
}
