<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserDashboardController extends Controller
{
    public function home()
    {
        $css = '/assets/css/users/create.css';
        $title = 'User - Dashboard';

        return view('dashboard.user', ['css' => $css, 'title' => $title]);
    }
}
