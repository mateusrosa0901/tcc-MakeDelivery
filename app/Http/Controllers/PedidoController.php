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
        ->orderBy('pedidos.id', 'DESC')
        ->first();
        
        $title = 'teste';
        $destino = "$pedido->destinatario_rua, $pedido->destinatario_numero - $pedido->destinatario_bairro, $pedido->destinatario_cidade - $pedido->destinatario_uf, $pedido->destinatario_cep";

        return view('pedidos.IndexEnviado', ['title' => $title, 'pedido' => $pedido, 'destino' => $destino]);
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

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
