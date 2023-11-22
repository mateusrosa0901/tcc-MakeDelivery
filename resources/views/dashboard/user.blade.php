@extends('layouts.app')

@section('css', $css)

@section('title', $title)

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

                <div class="nav">
                    <ul>
                        <li>Minhas entregas</li>
                        <li>Conta</li>
                        <li>Sair</li>
                    </ul>
                </div>
            </div>


            <div class="container">
                
            </div>
        </div>
    </div>
    
@endsection
