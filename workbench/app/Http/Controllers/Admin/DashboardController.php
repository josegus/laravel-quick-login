<?php

namespace Workbench\App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;

class DashboardController
{
    public function __invoke(): View
    {
        return view('admin.dashboard');
    }
}
