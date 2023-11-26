<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $tel = Auth::user()->telefone;
        $code = substr($tel, -4);

        $remetente = User::findOrFail(Auth::user()->id);
        $destinatario = User::findOrFail($request->destinatario);

        $apiKey = 'AIzaSyA-SfDxtbKlXS6AgOPpQZ4epZnf-zjMeYs';

        $origem = urlencode("$remetente->logradouro, $remetente->numero - $remetente->bairro, $remetente->cidade - $remetente->uf, $remetente->cep");
        $destino = urlencode("$destinatario->logradouro, $destinatario->numero - $destinatario->bairro, $destinatario->cidade - $destinatario->uf, $destinatario->cep");

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origem&destinations=$destino&mode=driving&language=pt-BR&sensor=false&key=$apiKey";

        $data = json_decode(file_get_contents($url), true);

        $distancia = $data['rows'][0]['elements'][0]['distance']['value'] / 1000;
        $tempo = $data['rows'][0]['elements'][0]['duration']['value'] / 60;

        $preco_peso = $request->peso * 0.50;
        $preco_distancia = $distancia * 0.50;
        $preco_tempo = $tempo * 0.30;

        $preco = $preco_peso + $preco_distancia + $preco_tempo;

        Pedido::create([
            'code' => $code,
            'desc' => $request->desc,
            'distancia' => $distancia,
            'tempo' => $tempo,
            'preco' => $preco,
            'peso' => $request->peso,
            'tamanho' => $request->tamanho,
            'id_destinatario' => $request->destinatario,
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
