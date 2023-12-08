<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function IndexEnviado($id)
    {
        $pedido = Pedido::join('users', 'users.id', '=', 'pedidos.id_destinatario')
        ->join('motoboys', 'motoboys.id', '=', 'pedidos.id_motoboy')
        ->select(
            'pedidos.*',
            'users.nome AS destinatario_nome',
            'users.email AS destinatario_email',
            'users.telefone AS destinatario_tel',
            'users.cep AS destinatario_cep',
            'users.numero AS destinatario_numero',
            'users.logradouro AS destinatario_rua',
            'users.bairro AS destinatario_bairro',
            'users.cidade AS destinatario_cidade',
            'users.uf AS destinatario_uf',
            'motoboys.nome AS motoboy_nome',
            'motoboys.telefone AS motoboy_tel',
            'motoboys.placa AS motoboy_placa',
        )
        ->where('pedidos.id', '=', $id)
        ->first();

        $title = 'teste';
        $destino = "$pedido->destinatario_rua, $pedido->destinatario_numero - $pedido->destinatario_bairro, $pedido->destinatario_cidade - $pedido->destinatario_uf, $pedido->destinatario_cep";

        return view('pedidos.IndexEnviado', ['title' => $title, 'pedido' => $pedido, 'destino' => $destino]);
    }

    public function IndexRecebido($id)
    {
        $pedido = Pedido::join('users', 'users.id', '=', 'pedidos.id_remetente')
        ->join('motoboys', 'motoboys.id', '=', 'pedidos.id_motoboy')
        ->select(
            'pedidos.*',
            'users.nome AS remetente_nome',
            'users.email AS remetente_email',
            'users.telefone AS remetente_tel',
            'users.cep AS remetente_cep',
            'users.numero AS remetente_numero',
            'users.logradouro AS remetente_rua',
            'users.bairro AS remetente_bairro',
            'users.cidade AS remetente_cidade',
            'users.uf AS remetente_uf',
            'motoboys.nome AS motoboy_nome',
            'motoboys.telefone AS motoboy_tel',
            'motoboys.placa AS motoboy_placa',
        )
        ->where('pedidos.id', '=', $id)
        ->first();

        $title = 'teste';
        $origem = "$pedido->remetente_rua, $pedido->remetente_numero - $pedido->remetente_bairro, $pedido->remetente_cidade - $pedido->remetente_uf, $pedido->remetente_cep";

        return view('pedidos.IndexRecebido', ['title' => $title, 'pedido' => $pedido, 'origem' => $origem]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Pedido - Novo';

        return view('pedidos.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $code = substr(uniqid(rand()), 0, 4);

        $remetente = User::findOrFail(Auth::user()->id);
        $destinatario = User::where('email', '=', $request->destinatario)->firstOrFail();

        $apiKey = 'AIzaSyA-SfDxtbKlXS6AgOPpQZ4epZnf-zjMeYs';

        $origem = urlencode("$remetente->logradouro, $remetente->numero - $remetente->bairro, $remetente->cidade - $remetente->uf, $remetente->cep");
        $destino = urlencode("$destinatario->logradouro, $destinatario->numero - $destinatario->bairro, $destinatario->cidade - $destinatario->uf, $destinatario->cep");

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origem&destinations=$destino&mode=driving&language=pt-BR&sensor=false&key=$apiKey";

        $data = json_decode(file_get_contents($url), true);

        $distancia = $data['rows'][0]['elements'][0]['distance']['value'] / 1000;
        $tempo = $data['rows'][0]['elements'][0]['duration']['value'] / 60;

        $preco_peso = $request->peso * 0.15;
        $preco_distancia = $distancia * 1.50;
        $preco_tempo = $tempo * 0.15;

        $preco = $preco_peso + $preco_distancia + $preco_tempo;
        $motoboy_preco = $preco - ($preco / 100 * 40);

        Pedido::create([
            'code' => $code,
            'desc' => $request->desc,
            'distancia' => $distancia,
            'tempo' => $tempo,
            'preco' => $preco,
            'motoboy_preco' => $motoboy_preco,
            'peso' => $request->peso,
            'tamanho' => $request->tamanho,
            'id_destinatario' => $destinatario->id,
            'id_remetente' => Auth::user()->id,
        ]);

        return redirect()->route('user.dashboard');
    }

    public function aceitar($id)
    {
        Pedido::where('id', $id)
        ->update([
            'id_motoboy' => Auth::guard('motoboys')->user()->id,
            'status' => 'Em rota'
        ]);

        $pedido = Pedido::where('id', $id)->first();

        $remetente = Pedido::join('users', 'users.id', '=', 'pedidos.id_remetente')
        ->select(
            'users.nome AS remetente_nome',
            'users.email AS remetente_email',
            'users.telefone AS remetente_tel',
            'users.cep AS remetente_cep',
            'users.numero AS remetente_numero',
            'users.logradouro AS remetente_rua',
            'users.bairro AS remetente_bairro',
            'users.cidade AS remetente_cidade',
            'users.uf AS remetente_uf',
        )
        ->where('pedidos.id', '=', $id)
        ->first();

        $origem = "$remetente->remetente_rua, $remetente->remetente_numero - $remetente->remetente_bairro, $remetente->remetente_cidade - $remetente->remetente_uf, $remetente->remetente_cep";

        $destinatario = Pedido::join('users', 'users.id', '=', 'pedidos.id_destinatario')
        ->select(
            'users.nome AS destinatario_nome',
            'users.email AS destinatario_email',
            'users.telefone AS destinatario_tel',
            'users.cep AS destinatario_cep',
            'users.numero AS destinatario_numero',
            'users.logradouro AS destinatario_rua',
            'users.bairro AS destinatario_bairro',
            'users.cidade AS destinatario_cidade',
            'users.uf AS destinatario_uf',
        )
        ->where('pedidos.id', '=', $id)
        ->first();

        $destino = "$destinatario->destinatario_rua, $destinatario->destinatario_numero - $destinatario->destinatario_bairro, $destinatario->destinatario_cidade - $destinatario->destinatario_uf, $destinatario->destinatario_cep";
    }
}
