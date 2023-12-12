@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/motoboys/dashboard.css">
    <link rel="stylesheet" href="/assets/css/motoboys/entrega.css">
@endsection

@section('content')
    <div class="main">
        <header>
            <div class="logo">
                <img src="/assets/img/users/delivery.svg" alt="">
            </div>

            <span>{{Auth::guard('motoboys')->user()->nome}}</span>
        </header>

        <div class="content">
            <div id="map"></div>

            <div class="info">
                <p>Código da entrega: <span>{{$pedido->code}}</span></p>
                <div class="row s-around">
                    <p><span>R$ {{number_format($pedido->motoboy_preco, 2, ',', '')}}</span></p>
                    <p><span>{{number_format($pedido->distancia, 2, '.', '')}} Km</span></p>
                </div>
                <p>Contato: <span>{{$remetente->remetente_tel}}</span></p>

                <div class="buttom" onclick="location.href='{!! route('pedido.concluir', $pedido->id) !!}'">
                    <p>Concluir entrega</p>
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
                destination: '{!! $destino !!}',
                travelMode: google.maps.TravelMode['DRIVING'],
                })
                .then((response) => {
                directionsRenderer.setDirections(response);
                })
        }

        window.initMap = initMap;
    </script>

@endsection
