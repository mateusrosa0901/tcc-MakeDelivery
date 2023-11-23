<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserDashboardController extends Controller
{
    public function home()
    {
        $title = 'User - Dashboard';

        return view('dashboard.user', ['title' => $title]);
    }
}
