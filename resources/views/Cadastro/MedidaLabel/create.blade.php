@extends('adminlte::page')

@section('title', 'Clínicas')

@section('content_header')
<h1>Lista de Abas</h1>
@stop

@section('content')

<div class="container">
    <h1 class="mb-4">Adicionar Medida Label</h1>

    <form action="{{ route('medida_labels.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário</label>
            <select class="form-select" name="user_id" id="user_id" required>
                <option value="">Selecione um Usuário</option>
                @foreach ($profissionais as $profissional)
                    <option value="{{ $profissional->id }}">{{ $profissional->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="medida_label" class="form-label">Medida Label</label>
            <input type="text" class="form-control" name="medida_label" id="medida_label" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('medida_labels.index') }}" class="btn btn-secondary">Voltar</a>
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