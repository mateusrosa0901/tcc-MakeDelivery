<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function home()
    {
        $title = 'User - Dashboard';

        $pedidos = Pedido::where('id_remetente', '=', Auth::user()->id)->get();

        return view('dashboard.user', ['title' => $title, 'pedidos' => $pedidos]);
    }
}
