@extends('layouts.app')

@section('css', $css)

@section('title', $title)

@section('content')
    {{ auth('motoboys')->user()->nome }}
@endsection
