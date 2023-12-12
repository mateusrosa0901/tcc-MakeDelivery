@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/create.css">
@endsection

@section('content')
    <div class="main-cadastro">
        <div class="left-cadastro">
            <h1>Faça login aqui!</h1>
            <img src="/assets/img/motoboys/delivery.svg" class="estoque-image" alt="estoque-laranja-anime">
        </div>

        <div class="right-cadastro">
            <div class="card-cadastro">
                @error('login')
                    <span class="error">{{ $message }}</span>
                @enderror
                <form class="form-cadastro" action="{{ Route('motoboy.auth') }}" method="POST">
                    @csrf

                    <div class="textfield">
                        <label for="idemail">Email:</label>
                        <input type="email" name="email" id="idemail" required placeholder="exemplo@email.com">
                    </div>

                    <div class="textfield">
                        <label for="idpassword">Senha:</label>
                        <input type="password" name="password" id="idpassword" required placeholder="12345Ab@">
                    </div>

                    <input class="sub-buttom" type="submit" value="LOGIN">
                </form>
            </div>
        </div>
    </div>
@endsection
