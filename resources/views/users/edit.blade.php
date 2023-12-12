@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/dashboard.css">
    <link rel="stylesheet" href="/assets/css/users/create.css">
    <link rel="stylesheet" href="/assets/css/users/form-update.css">
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
                    <a href="{{ route('user.dashboard') }}">Meus Pedidos</a>
                    <a href="#" class="c-roxo">Conta</a>
                    <a href="{{ route('user.logout') }}">Sair</a>
                </aside>
            </div>


            <div class="container">
                <form class="form-cadastro update" action="{{ route('user.update') }}" method="post">
                    @csrf
                    @method('put')

                    <div class="textfield">
                        <label for="idnome">Nome:</label>
                        <input type="text" name="nome" id="idnome" required minlength="3" maxlength="45" value="{{Auth::user()->nome}}">
                    </div>

                    <div class="textfield">
                        <label for="idcpf">CPF:</label>
                        <input type="text" name="cpf" id="idcpf" value="{{Auth::user()->cpf}}">
                    </div>

                    <div class="textfield row">
                        <div class="textfield cep">
                            <label for="idcep">CEP:</label>
                            <input type="text" name="cep" id="idcep" value="{{Auth::user()->cep}}">
                        </div>
                        <div class="textfield numero">
                            <label for="idnumero">N°</label>
                            <input type="text" name="numero" id="idnumero" value="{{Auth::user()->numero}}">
                        </div>
                    </div>

                    <input class="sub-buttom" type="submit" value="Atualizar">
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#idcpf").mask('000.000.000-00', {reverse: false});
        });

        $(document).ready(function () {
            $("#idcep").mask('00000-000', {reverse: false});
        });
    </script>
@endsection
