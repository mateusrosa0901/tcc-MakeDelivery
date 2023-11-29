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

        $enviados = Pedido::join('users', 'users.id', '=', 'pedidos.id_destinatario')
        ->join('motoboys', 'motoboys.id', '=', 'pedidos.id_motoboy')
        ->select(
            'pedidos.*',
            'users.nome AS destinatario_nome',
            'users.email AS destinatario_email',
            'users.telefone AS destinatario_tel',
            'users.cep AS destinatario_cep',
            'motoboys.nome AS motoboy_nome',
        )
        ->where('id_remetente', '=', Auth::user()->id)
        ->orderBy('pedidos.id', 'DESC')
        ->get();

        $recebidos = Pedido::join('users', 'users.id', '=', 'pedidos.id_remetente')
        ->join('motoboys', 'motoboys.id', '=', 'pedidos.id_motoboy')
        ->select(
            'pedidos.*',
            'users.nome AS remetente_nome',
            'users.email AS remetente_email',
            'users.telefone AS remetente_tel',
            'users.cep AS remetente_cep',
            'motoboys.nome AS motoboy_nome',
        )
        ->where('id_destinatario', '=', Auth::user()->id)
        ->orderBy('pedidos.id', 'DESC')
        ->get();
        
        //dd($enviados);

        return view('dashboard.user', ['title' => $title, 'enviados' => $enviados, 'recebidos' => $recebidos]);
    }
}
