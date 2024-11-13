@extends('adminlte::page')

@section('title', 'Clínicas')

@section('content_header')
    <h1>Clínicas</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('clinicas.create') }}" class="btn btn-primary mb-3">Adicionar Nova Clínica</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Nome Fatasia</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clinicas as $clinica)
                <tr>
                    <td>{{ $clinica->nome_fantasia }}</td>
                    <td>{{ $clinica->cidade }}</td>
                    <td>{{ $clinica->uf }}</td>
                    <td>
                        <a href="{{ route('clinicas.edit', $clinica->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('clinicas.destroy', $clinica->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
