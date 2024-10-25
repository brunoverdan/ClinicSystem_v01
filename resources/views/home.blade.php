@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="bg-container">
    <p class="text-white">Seja bem vindo ao sistema Gerenciamento de Cliente</p>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .bg-container {
            background-image: url('{{ asset('fundoRevegora.jpg') }}'); /* Caminho atualizado */ /* Caminho para sua imagem */
            background-size: cover;
            background-position: center;
            min-height: 100vh; /* Altura total da visualização */
            color: white;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
