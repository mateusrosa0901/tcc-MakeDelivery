@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/motoboys/dashboard.css">
@endsection

@section('content')
    <div class="main">
        <header>
            <div class="logo">
                <img src="/assets/img/users/delivery.svg" alt="">
            </div>

            <span>{{Auth::guard('motoboys')->user()->nome}}</span>
        </header>

        <div class="content">
            <div class="pedidos">
                @foreach ($pedidos as $pedido)
                    <div class="pedido">
                        <div class="desc">
                            {{$pedido->desc}}
                        </div>
                        <div class="preco">
                            R$ {{number_format($pedido->motoboy_preco, 2, ',', '')}}
                        </div>
                        <div class="distancia">
                            Distancia: <span>{{number_format($pedido->distancia, 2, '.', '')}} Km</span>
                        </div>
                        <div class="btn">
                            <div class="btn-aceitar" onclick="location.href='{!! route('pedido.aceitar', $pedido->id) !!}'">
                                Aceitar Entrega
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
