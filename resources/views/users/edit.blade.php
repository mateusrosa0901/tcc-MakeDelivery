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
                    <a href="{{ route('user.dashboard') }}">Minhas entregas</a>
                    <a href="#">Conta</a>
                    <a href="{{ route('user.logout') }}">Sair</a>
                </aside>
            </div>


            <div class="container">
                <form action="" method="post">
                    <label for="idcpf">CPF:</label>
                    <input type="text" name="cpf" id="idcpf">

                    <label for="idcep">CEP:</label>
                    <input type="text" name="cep" id="idcep">

                    <label for="idnumero">N°</label>
                    <input type="text" name="numero" id="idnumero">
                </form>
            </div>
        </div>
    </div>
    
@endsection