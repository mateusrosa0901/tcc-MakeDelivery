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
                        <img src="/assets/profile/users/{{ Auth::user()->perfil_img }}" alt="">
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

                <div class="sw-bt-box">
                    <div class="sw-bt">
                        <button  class="bb-none" onclick="enviados()">ENVIADOS</button>
                        <p>|</p>
                        <button class="bb-none" onclick="recebidos()">RECEBIDOS</button>
                    </div>
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
                                @foreach ($enviados as $enviado)
                                    <tr onclick="location.href='{!! route('pedido.enviado', $enviado->id) !!}'">
                                        <td>{{ date('d/m/Y', strtotime($enviado->created_at)) }}</td>
                                        @if ( $enviado->motoboy_nome )
                                            <td>{{ $enviado->motoboy_nome }}</td>
                                        @endif
                                        <td>{{ $enviado->status }}</td>
                                        <td>R$ {{ $enviado->preco }}</td>
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
                                    <th>Remetente</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recebidos as $recebido)
                                    <tr onclick="location.href='{!! route('pedido.enviado', $recebido->id) !!}'">
                                        <td>{{ date('d/m/Y', strtotime($recebido->created_at)) }}</td>
                                        @if ( $recebido->motoboy_nome )
                                            <td>{{ $recebido->motoboy_nome }}</td>
                                        @endif
                                        <td>{{ $recebido->remetente_nome }}</td>
                                        <td>{{ $recebido->status }}</td>
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
