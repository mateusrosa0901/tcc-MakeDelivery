<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MotoboyDashboardController extends Controller
{
    public function home()
    {
        $title = 'Motoboy - Dashboard';

        $pedidos = Pedido::where('pedidos.status', '=', 'Procurando entregador')
        ->orderBy('pedidos.id', 'DESC')
        ->get();

        return view('dashboard.motoboy', ['title' => $title, 'pedidos' => $pedidos]);
    }
}
