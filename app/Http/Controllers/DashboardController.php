<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $css = '/assets/css/users/create.css';
        $title = 'Dash';

        return view('users.dashboard', ['css' => $css, 'title' => $title]);
    }
}
