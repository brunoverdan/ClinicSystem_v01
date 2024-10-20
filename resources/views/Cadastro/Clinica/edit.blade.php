@extends('adminlte::page')

@section('title', 'Editar Clínica')

@section('content_header')
    <h1>Editar Clínica</h1>
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

    <form action="{{ route('clinicas.update', $clinica->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $clinica->nome }}" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" value="{{ $clinica->telefone }}">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" name="cidade" value="{{ $clinica->cidade }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" value="{{ $clinica->endereco }}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" value="{{ $clinica->email }}">
                </div>
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" class="form-control" name="uf" maxlength="2" value="{{ $clinica->uf }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('clinicas.index') }}" class="btn btn-secondary">Voltar</a>
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
