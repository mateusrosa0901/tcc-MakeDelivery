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
                    <form action="{{ route('pedido.create') }}" method="get">
                        <input class="sub-bt" type="submit" value="Novo Pedido"> 
                    </form>
                </div>

                <div class="choice">
                    <button onclick="enviados()">enviados</button>
                    <button onclick="recebidos()">recebidos</button>
                </div>
                
                <div class="pedidos">
                    <div id="enviados" class="tabela">
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
                                    <tr onclick="location.href='{{ route('user.edit') }}'">
                                        <td>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</td>
                                        @if ( $pedido->motoboy_nome )
                                            <td>{{ $pedido->motoboy_nome }}</td>
                                        @endif
                                        <td>{{ $pedido->status }}</td>
                                        <td>R$ {{ $pedido->preco }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="recebidos" class="tabela d-none">
                        <table>
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Entregador</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr onclick="location.href='{{ route('user.edit') }}'">
                                        <td>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</td>
                                        @if ( $pedido->motoboy_nome )
                                            <td>{{ $pedido->motoboy_nome }}</td>
                                        @endif
                                        <td>{{ $pedido->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        function enviados(){
            id = document.getElementById("enviados");
            id.style.display = 'block';

            id = document.getElementById("recebidos");
            id.style.display = 'none'
        }

        function recebidos(){
            id = document.getElementById("recebidos");
            id.style.display = 'block';

            id = document.getElementById("enviados");
            id.style.display = 'none'
        }
    </script>

@endsection
