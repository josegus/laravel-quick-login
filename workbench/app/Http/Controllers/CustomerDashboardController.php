<?php

namespace Workbench\App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CustomerDashboardController
{
    public function __invoke(): View
    {
        return view('customer-dashboard');
    }
}
