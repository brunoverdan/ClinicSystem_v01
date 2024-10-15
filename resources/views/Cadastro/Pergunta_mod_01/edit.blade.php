@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<h1>Editar Pergunta</h1>

    <form action="{{ route('pergunta_mod_01.update', $perguntaMod01->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Pergunta:</label>
        <input type="text" name="pergunta" value="{{ $perguntaMod01->pergunta }}" required>
        <label>Ativo:</label>
        <input type="number" name="ativo" value="{{ $perguntaMod01->ativo }}" required>
        <button type="submit">Salvar</button>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
