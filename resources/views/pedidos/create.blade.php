@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/users/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/users/create.css">
    <link rel="stylesheet" href="/assets/css/pedidos/create.css">
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "AIzaSyA-SfDxtbKlXS6AgOPpQZ4epZnf-zjMeYs",
        v: "weekly",
        // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
        // Add other bootstrap parameters as needed, using camel case.
        });
  </script>
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

                <div id="map"></div>
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


    <script>
        let map;
        function initMap() {
            const { Map } = google.maps.importLibrary("maps") as google.maps.MapsLibrary;
            const { directionsService } = google.maps.importLibrary("DirectionsService") as google.maps.DirectionsService;
            const { directionsRenderer } = google.maps.importLibrary("DirectionsRenderer") as google.maps.DirectionsRenderer;
            const position = { lat: -15.344, lng: 200.031 };

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: position,
                mapId: "terrain", 
            });

            directionsRenderer.setMap(map);

            directionsService.route({
                origin: 'Toronto, Canadá',
                destination: 'Montreal, Canadá',
                travelMode: google.maps.TravelMode.DRIVING,
            });
        }
        initMap();
    </script>

@endsection
