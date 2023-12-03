@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/users/create.css">
    <link rel="stylesheet" href="/assets/css/pedidos/create.css">
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
                    <a href="{{ route('user.edit') }}">Conta</a>
                    <a href="{{ route('user.logout') }}">Sair</a>
                </aside>
            </div>


            <div class="container">
                <form class="form-cadastro create" action="{{ route('pedido.store') }}" method="post">
                    @csrf

                    <div class="textfield">
                        <label for="iddesc">Descrição da encomenda:</label>
                        <input type="text" name="desc" id="iddesc" required placeholder="Furadeira">
                    </div>
                    <div class="textfield">
                        <label for="idpeso">Peso:</label>
                        <input type="text" name="peso" id="idpeso" required placeholder="2.00 Kg">
                    </div>
                    <div class="textfield">
                        <label for="idtamanho">Tamanho:</label>
                        <input type="text" name="tamanho" id="idtamanho" required placeholder="21x07x19">
                    </div>
                    <div class="textfield">
                        <label for="iddestinatario">Email do destinatario:</label>
                        <input type="text" name="destinatario" id="iddestinatario" placeholder="destino@gmail">
                    </div>

                    <input class="sub-buttom" type="submit" value="Nova Entrega">
                </form>

                <iframe
                    width="500"
                    height="450"
                    style="border:2"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA-SfDxtbKlXS6AgOPpQZ4epZnf-zjMeYs&q={{urlencode(Auth::user()->logradouro.','. Auth::user()->numero.','. Auth::user()->bairro.','. Auth::user()->cidade.','. Auth::user()->uf);}}">
                </iframe>
            </div>
        </div>
    </div>

    <script>
        //aData = {}
        $( function() {
            $( "#iddestinatario" ).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/user/search",
                        type: 'post',
                        dataType: 'json',

                        success: function(data) {
                            //console.log(data);

                            /*aData = $.map(data, function(value, key) {
                                return {
                                    label: value.email,
                                };
                            });*/

                            var results = $.ui.autocomplete.filter(data, request.term);
                            response(results);
                        }
                    })
                }
            })
        })
    </script>

@endsection
