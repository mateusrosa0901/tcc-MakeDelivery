@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
@endsection

@section('content')
    <div class="main">
        <header>
            <div class="logo">
                <img src="/assets/img/users/delivery.svg" alt="">
            </div>

            <span>{{ Auth::user()->nome }}</span>
        </header>

        <div class="content">
            <div class="left-user">
                <div class="user">
                    <div class="user-img">
                        <img src="/assets/img/users/Foto_Perfil.jpg" alt="">
                    </div>

                    <span>{{ Auth::user()->nome }}</span>
                </div>

                <aside>
                    <a href="#">Meus Pedidos</a>
                    <a href="{{ route('user.edit') }}">Conta</a>
                    <a href="{{ route('user.logout') }}">Sair</a>
                </aside>
            </div>


            <div class="container">
                <div class="top">
                   <a class="btn" href="{{ route('pedido.create') }}">Novo Pedido</a> 
                </div>
                
                <div class="envios">
                    <table>
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Entregador</th>
                                <th>Status</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</td>

                                    <td>{{ $pedido->motoboy_nome }}</td>

                                    <td>{{ $pedido->status }}</td>

                                    <td>R$ {{ $pedido->preco }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

@endsection
