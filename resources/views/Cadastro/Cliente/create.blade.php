@extends('adminlte::page')

@section('title', 'Cadastro de Cliente')

@section('content_header')
    <h1>Adicionar Cliente</h1>
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

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" name="telefone">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" name="cidade">
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Nao_Informar">Não Informar</option>
                    </select>
                </div>
               
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" class="form-control" name="uf" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="data_nascimento">
                </div>
                
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacao">Observacao:</label>
                    <textarea type="text" class="form-control" name="observacao" rows="5"></textarea>
                </div>
            </div>
            {{-- Select de Profissionais apenas se o usuário for Administrador --}}
            @if (auth()->check() && auth()->user()->nivel === 'administrativo')
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="user_id">Selecionar Profissional:</label>
                        <select class="form-control" name="user_id">
                            <option value="">Selecione um profissional</option>
                            @foreach ($profissionais as $profissional)
                                <option value="{{ $profissional->id }}">{{ $profissional->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
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
