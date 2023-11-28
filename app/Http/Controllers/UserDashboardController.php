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

        $pedidos = Pedido::join('users', 'users.id', '=', 'pedidos.id_destinatario')
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
        
        //dd($pedidos);

        return view('dashboard.user', ['title' => $title, 'pedidos' => $pedidos]);
    }
}
