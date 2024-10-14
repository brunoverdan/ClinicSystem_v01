@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container">
    <h1>Evoluções</h1>
    <a href="{{ route('evolucoes.create') }}" class="btn btn-primary mb-3">Registrar Nova Evolução</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evolucoes as $evolucao)
            <tr>
                <td>{{ $evolucao->id }}</td>
                <td>{{ $evolucao->descricao }}</td>
                <td>
                    {{ $evolucao->data ? Carbon::parse($evolucao->data)->format('d/m/Y') : '' }}
                </td>
                <td>{{ $evolucao->cliente->nome }}</td>
                <td>
                    <a href="{{ route('evolucoes.edit', $evolucao->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('evolucoes.destroy', $evolucao->id) }}" method="POST" style="display:inline;">
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
