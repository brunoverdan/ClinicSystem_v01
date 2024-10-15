@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <h1>Editar Pergunta</h1>
    
    <form action="{{ route('modelo_perguntas.update', $modeloPergunta->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="pergunta">Pergunta</label>
            <input type="text" name="pergunta" class="form-control" value="{{ old('pergunta', $modeloPergunta->pergunta) }}" required>
        </div>

        <div class="form-group">
            <label for="modelo">Modelo</label>
            <select name="modelo" class="form-control" required>
                <option value="modelo_01" {{ $modeloPergunta->modelo == 'modelo_01' ? 'selected' : '' }}>Modelo 01</option>
                <option value="modelo_02" {{ $modeloPergunta->modelo == 'modelo_02' ? 'selected' : '' }}>Modelo 02</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
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
