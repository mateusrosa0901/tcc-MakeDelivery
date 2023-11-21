<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MotoboyDashboardController extends Controller
{
    public function home()
    {
        $css = '/assets/css/users/create.css';
        $title = 'Motoboy - Dashboard';

        return view('dashboard.motoboy', ['css' => $css, 'title' => $title]);
    }
}
