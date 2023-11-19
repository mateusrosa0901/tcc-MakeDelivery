@extends('layouts.app')

@section('css', $css)

@section('title', $title)

@section('content')
    {{ auth()->user()->nome }}
@endsection
