@extends('layouts.app')

@section('title', $title)

@section('head')
    <link rel="stylesheet" href="/assets/css/motoboys/dashboard.css">
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
            
        </div>
    </div>

@endsection
