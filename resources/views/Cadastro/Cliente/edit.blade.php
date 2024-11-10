@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente: <label for="profissional">{{ $cliente->user->name }}</label></h1>
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
            <!-- Coluna Esquerda -->
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
                <div class="form-group">
                    <label for="EstadoCivil">Estado Civil:</label>
                    <select class="form-control" name="EstadoCivil">
                        <option value="">Selecione</option>
                        <option value="Solteiro" {{ $cliente->EstadoCivil == 'Solteiro' ? 'selected' : '' }}>Solteiro</option>
                        <option value="Casado" {{ $cliente->EstadoCivil == 'Casado' ? 'selected' : '' }}>Casado</option>
                        <option value="Divorciado" {{ $cliente->EstadoCivil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                        <option value="Viúvo" {{ $cliente->EstadoCivil == 'Viúvo' ? 'selected' : '' }}>Viúvo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="CPF">CPF:</label>
                    <input type="text" class="form-control" name="CPF" value="{{ $cliente->CPF }}">
                </div>
            </div>

            <!-- Coluna Direita -->
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
                    <input type="text" class="form-control" name="uf" value="{{ $cliente->uf }}" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="data_nascimento" value="{{ $cliente->data_nascimento }}">
                </div>
                <div class="form-group">
                    <label for="Filhos">Filhos:</label>
                    <input type="number" class="form-control" name="Filhos" value="{{ $cliente->Filhos }}" min="0">
                </div>
                <div class="form-group">
                    <label for="Profissao">Profissão:</label>
                    <input type="text" class="form-control" name="Profissao" value="{{ $cliente->Profissao }}">
                </div>
            </div>

            <!-- Responsável e Contato Responsável -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Responsavel">Responsável:</label>
                    <input type="text" class="form-control" name="Responsavel" value="{{ $cliente->Responsavel }}">
                </div>
                <div class="form-group">
                    <label for="ContatoResponsavel">Contato do Responsável:</label>
                    <input type="text" class="form-control" name="ContatoResponsavel" value="{{ $cliente->ContatoResponsavel }}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="observacao">Observações:</label>
                    <textarea class="form-control" name="observacao" rows="5">{{ $cliente->observacao }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@stop

@section('css')
    {{-- Adicionar estilos personalizados aqui, se necessário --}}
@stop

@section('js')
    <script> console.log("Cliente atualizado com sucesso!"); </script>
@stop