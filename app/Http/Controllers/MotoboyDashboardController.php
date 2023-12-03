<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MotoboyDashboardController extends Controller
{
    public function home()
    {
        $title = 'Motoboy - Dashboard';

        return view('dashboard.motoboy', ['title' => $title]);
    }
}
