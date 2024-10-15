@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="container">
    <h1>Lista de Perguntas</h1>
    <a href="{{ route('modelo_perguntas.create') }}" class="btn btn-primary mb-3">Adicionar Nova Pergunta</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Modelo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modeloPerguntas as $pergunta)
                <tr>
                    <td>{{ $pergunta->id }}</td>
                    <td>{{ $pergunta->pergunta }}</td>
                    <td>{{ $pergunta->modelo }}</td>
                    <td>
                        <a href="{{ route('modelo_perguntas.edit', $pergunta->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('modelo_perguntas.destroy', $pergunta->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
