@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar Pergunta</h1>

    <form action="{{ route('pergunta_mod_02.update', $perguntaMod02->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Pergunta</label>
            <input type="text" name="pergunta" class="form-control" value="{{ $perguntaMod02->pergunta }}" required>
        </div>

        <div class="form-group">
            <label>Mais</label>
            <input type="number" name="mais" class="form-control" value="{{ $perguntaMod02->mais }}">
        </div>

        <div class="form-group">
            <label>Menos</label>
            <input type="number" name="menos" class="form-control" value="{{ $perguntaMod02->menos }}">
        </div>

        <div class="form-group">
            <label>Direito</label>
            <input type="number" name="direito" class="form-control" value="{{ $perguntaMod02->direito }}">
        </div>

        <div class="form-group">
            <label>Esquerdo</label>
            <input type="number" name="esquerdo" class="form-control" value="{{ $perguntaMod02->esquerdo }}">
        </div>

        <div class="form-group">
            <label>Ativo</label>
            <input type="number" name="ativo" class="form-control" value="{{ $perguntaMod02->ativo }}" required>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('pergunta_mod_02.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
