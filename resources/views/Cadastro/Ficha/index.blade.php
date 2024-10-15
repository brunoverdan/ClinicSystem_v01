@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="container">
    <h1>Fichas de Clientes</h1>

    <!-- Botão para cadastrar nova ficha -->
    <div class="mb-3">
        <a href="{{ route('fichas.create') }}" class="btn btn-primary">Cadastrar Nova Ficha</a>
    </div>

   
    
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
