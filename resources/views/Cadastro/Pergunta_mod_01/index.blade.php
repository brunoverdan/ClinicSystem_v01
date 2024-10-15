@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<h1>Lista de Perguntas</h1>
    <a href="{{ route('pergunta_mod_01.create') }}">Criar Nova Pergunta</a>
    <ul>
        @foreach($perguntas as $pergunta)
            <li>{{ $pergunta->pergunta }} - <a href="{{ route('pergunta_mod_01.edit', $pergunta->id) }}">Editar</a></li>
        @endforeach
    </ul>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
