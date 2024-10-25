@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema Revigora</h1>
@stop

@section('content')

<div class="bg-container text-center">
    <img src="{{ asset('fundoRevegora.jpg') }}" alt="Imagem de Fundo" class="img-fluid">
    <p class="text-white mt-3">Seja bem vindo ao sistema Gerenciamento de Cliente</p>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .bg-container {
            min-height: 100vh; /* Altura total da visualização */
            color: white;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
