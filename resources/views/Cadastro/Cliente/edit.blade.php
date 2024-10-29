@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Profissional Responsavel <label for="profissional">{{$cliente->user->name}}</label></h1>
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

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $cliente->user_id }}" required>
        <div class="row">
            <div class="col-md-6">
                
                
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $cliente->nome }}" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" value="{{ $cliente->telefone }}">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" name="cidade" value="{{ $cliente->cidade }}">
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="Masculino" {{ $cliente->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Feminino" {{ $cliente->sexo == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                        <option value="Nao_Informar" {{ $cliente->sexo == 'Nao_Informar' ? 'selected' : '' }}>Não Informar</option>
                    </select>
                </div>
                
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" value="{{ $cliente->endereco }}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" value="{{ $cliente->email }}">
                </div>
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" class="form-control" name="uf" maxlength="2" value="{{ $cliente->uf }}">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="data_nascimento" value="{{ $cliente->data_nascimento }}">
                </div>
                
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacao">Observacao:</label>
                    <textarea type="text" class="form-control" name="observacao" rows="5">{{ $cliente->observacao }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
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
