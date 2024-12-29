<?php

namespace Workbench\App\Http\Controllers\Customer;

use Illuminate\Contracts\View\View;

class DashboardController
{
    public function __invoke(): View
    {
        return view('customer.dashboard');
    }
}
