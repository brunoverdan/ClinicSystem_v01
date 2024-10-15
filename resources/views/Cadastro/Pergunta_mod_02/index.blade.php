@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Lista de Perguntas</h1>
    <a href="{{ route('pergunta_mod_02.create') }}" class="btn btn-primary mb-3">Criar Nova Pergunta</a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perguntas as $pergunta)
            <tr>
                <td>{{ $pergunta->id }}</td>
                <td>{{ $pergunta->pergunta }}</td>
                <td>
                    <a href="{{ route('pergunta_mod_02.edit', $pergunta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('pergunta_mod_02.destroy', $pergunta->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
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
