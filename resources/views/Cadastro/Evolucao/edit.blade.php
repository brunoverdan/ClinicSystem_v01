@extends('adminlte::page')

@section('title', 'Editar Evolucao')

@section('content_header')
    <h1>Editar Evolucao</h1>
@stop

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evolucoes.update', $evolucao->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" name="descricao" value="{{ $evolucao->descricao }}" required>
                    <div class="form-group">
                        <label for="data">Data de Nascimento:</label>
                        <input type="date" class="form-control" name="data" value="{{ $evolucao->data }}">
                    </div>
                </div>
                
                
            </div>

        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <button onclick="window.history.back();" class="btn btn-secondary">Voltar</button>

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
