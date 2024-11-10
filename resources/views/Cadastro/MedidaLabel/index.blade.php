@extends('adminlte::page')

@section('title', 'Clínicas')

@section('content_header')
<h1>Lista de Abas</h1>
@stop

@section('content')

<div class="container">
    <h1 class="mb-4">Medidas Labels</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('medida_labels.create') }}" class="btn btn-primary mb-3">Adicionar Nova Medida Label</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Medida Label</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medidaLabels as $medidaLabel)
                <tr>
                    <td>{{ $medidaLabel->user->name }}</td>
                    <td>{{ $medidaLabel->medida_label }}</td>
                    <td>
                        <a href="{{ route('medida_labels.edit', $medidaLabel->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('medida_labels.destroy', $medidaLabel->id) }}" method="POST" style="display:inline;">
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