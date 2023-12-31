@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/assets/css/pedidos/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-SfDxtbKlXS6AgOPpQZ4epZnf-zjMeYs&callback=initMap&v=weekly" defer></script>
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
                <div class="cont-info">
                    <h1>{{$pedido->desc}} - {{ date('d/m/Y', strtotime($pedido->created_at)) }}</h1>
                    <div class="info">
                        <div class="pedido">
                            <h2>Pedido</h2>
                            <p>Código: <span>{{$pedido->code}}</span></p>
                            <p>Status: <span>{{$pedido->status}}</span></p>
                        </div>
                        <div class="entregador">
                            <h2>Entregador</h2>
                            <p>Nome: <span>{{$pedido->motoboy_nome}}</span></p>
                            <p>Placa: <span>{{$pedido->motoboy_placa}}</span></p>
                            <p>Telefone: <span><a href="tel:+55 {{$pedido->motoboy_tel}}">{{$pedido->motoboy_tel}}</a></span></p>
                        </div>
                        <div class="destinatario">
                            <h2>Remetente</h2>
                            <p>Nome: <span>{{$pedido->remetente_nome}}</span></p>
                            <p>Telefone: <span><a href="tel:+55 {{$pedido->remetente_tel}}">{{$pedido->remetente_tel}}</a></span></p>
                            <p>Email: <span><a href="mailto:{{$pedido->remetente_email}}">{{$pedido->remetente_email}}</a></span></p>
                        </div>
                    </div>
                </div>

                <div class="bg-map">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-SfDxtbKlXS6AgOPpQZ4epZnf-zjMeYs&callback=initMap&v=weekly" defer></script>

    <script>
        function initMap() {
            const directionsRenderer = new google.maps.DirectionsRenderer({
                draggable: false,
            });
            const directionsService = new google.maps.DirectionsService();
            const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: { lat: -15.793889, lng: -47.882778 },
            draggable: true,
            disableDefaultUI: true,
            });

            directionsRenderer.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsRenderer);
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer) {

            directionsService
                .route({
                origin: '{!! $origem !!}',
                destination: '{!! Auth::user()->logradouro !!}, {!! Auth::user()->numero !!} - {!! Auth::user()->bairro !!}, {!! Auth::user()->cidade !!} - {!! Auth::user()->uf !!}, {!! Auth::user()->cep !!}',
                travelMode: google.maps.TravelMode['DRIVING'],
                })
                .then((response) => {
                directionsRenderer.setDirections(response);
                })
        }

        window.initMap = initMap;
    </script>

@endsection
