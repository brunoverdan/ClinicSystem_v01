@extends('adminlte::page')

@section('title', 'Clínicas')

@section('content_header')
<h1>Lista de Abas</h1>
@stop

@section('content')
<div class="container mt-4">
    
    <a href="{{ route('abas.create') }}" class="btn btn-primary mb-3">Criar Aba</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Aba</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($abas as $aba)
                        <tr>
                            <td>{{ $aba->aba }}</td>
                            <td>{{ $aba->user->name }}</td>
                            <td>
                                <a href="{{ route('abas.edit', $aba) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('abas.destroy', $aba) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta aba?');">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
