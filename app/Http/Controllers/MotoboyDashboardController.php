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

        $pedidos = Pedido::join('users', 'users.id', '=', 'pedidos.id_destinatario')
        ->select(
            'pedidos.*',
            'users.nome AS destinatario_nome',
            'users.email AS destinatario_email',
            'users.telefone AS destinatario_tel',
            'users.cep AS destinatario_cep',
        )
        ->where('pedidos.status', '=', 'Procurando entregador')
        ->orderBy('pedidos.id', 'DESC')
        ->get();

        return view('dashboard.motoboy', ['title' => $title, 'pedidos' => $pedidos]);
    }
}
