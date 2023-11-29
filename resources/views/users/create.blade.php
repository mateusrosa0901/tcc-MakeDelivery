@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/create.css">
    <link rel="stylesheet" href="/assets/css/users/form-update.css">
@endsection

@section('content')
    <div class="main-cadastro">
        <div class="left-cadastro">
            <h1>Crie sua conta aqui!</h1>
            <img src="/assets/img/users/delivery.svg" class="estoque-image" alt="estoque-laranja-anime">
        </div>

        <div class="right-cadastro">
            <div class="card-cadastro">
                <form class="form-cadastro" action="{{ Route('user.store') }}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="tel" id="idtel" required placeholder="(00)9 0000-0000">
                    </div>

                    <div class="textfield">
                        <label for="idcpf">CPF:</label>
                        <input type="text" name="cpf" id="idcpf" placeholder="000.000.000-00">
                    </div>

                    <div class="textfield row">
                        <div class="textfield cep">
                            <label for="idcep">CEP:</label>
                            <input type="text" name="cep" id="idcep" placeholder="00000-000">
                        </div>
                        <div class="textfield numero">
                            <label for="idnumero">N°</label>
                            <input type="text" name="numero" id="idnumero" placeholder="00A">
                        </div>
                    </div>

                    <div class="textfield">
                        <label for="idperfil">Foto de perfil:</label>
                        <input type="file" name="perfil" id="idperfil">
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

        $(document).ready(function () {
            $("#idcpf").mask('000.000.000-00', {reverse: false});
        });

        $(document).ready(function () {
            $("#idcep").mask('00000-000', {reverse: false});
        });
    </script>
@endsection
