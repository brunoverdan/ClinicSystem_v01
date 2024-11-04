@extends('adminlte::page')

@section('title', 'Editar Evolução')

@section('content_header')
    <h1>Editar Evolução</h1>
@stop

@section('content')
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evolucoes.update', $evolucao->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="4" required>{{ $evolucao->descricao }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="data" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="data" value="{{ $evolucao->data }}">
            </div>

            <input type="hidden" name="evolucao_id" value="{{ $evolucao->id }}">

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Salvar</button>
                <button type="button" onclick="window.history.back();" class="btn btn-secondary">Voltar</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    {{-- Add extra stylesheets here if needed --}}
@stop

@section('js')
    <script>
        console.log("Todos Direitos Reservados!");
    </script>
@stop
