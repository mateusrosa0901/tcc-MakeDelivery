@extends('layouts.app')

@section('css', $css)

@section('title', $title)

@section('content')
    <div class="main">
        <header>
            <div class="logo">
                <img src="/assets/img/users/delivery.svg" alt="">
            </div>

            <span>{{ auth()->user()->nome }}</span>
        </header>

        <div class="content">
            <div class="btn"><a href="/">Nova Entrega</a></div>


        </div>
    </div>
    
@endsection
