@extends('layouts.app')

@section('css', $css)

@section('title', $title)

@section('content')
    <div class="main-cadastro">
        <div class="left-cadastro">
            <h1>Crie sua conta aqui!</h1>
            <img src="/assets/img/users/delivery.svg" class="estoque-image" alt="estoque-laranja-anime">
        </div>

        <div class="right-cadastro">
            <div class="card-cadastro">
                <form class="form-cadastro" action="{{ Route('user.store') }}" method="POST">
                    @csrf

                    <div class="textfield">
                        <label for="idnome">Nome:</label>
                        <input type="text" name="nome" id="idnome" required minlength="3" maxlength="45" placeholder="Nome">
                    </div>

                    <div class="textfield">
                        <label for="idemail">Email:</label>
                        <input type="email" name="email" id="idemail" required placeholder="exemplo@email.com">
                    </div>

                    <div class="textfield">
                        <label for="idpassword">Senha:</label>
                        <input type="password" name="password" id="idpassword" required placeholder="12345Ab@">
                    </div>

                    <div class="textfield">
                        <label for="idtel">Telefone:</label>
                        <input type="text" name="tel" id="idtel" required placeholder="(31)91234-5678">
                    </div>

                    <input class="sub-buttom" type="submit" value="CADASTRAR">
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () { 
            $("#idtel").mask('(00)0 0000-0000', {reverse: false});
        });
    </script>
@endsection
