@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<h5>Cadastro>Ficha Cliente</h5>
@stop

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Lista de Clientes</h2>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('clientes.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Adicionar Novo Cliente
            </a>
        </div>
    </div>

    {{-- Alerta de sucesso --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Formulário de pesquisa --}}
    <form action="{{ route('fichas.search') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="query" id="query" class="form-control" placeholder="{{$descricaoBarraBusca}}" aria-label="Pesquisar Cliente">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Pesquisar
                </button>
            </div>
        </div>
    </form>

    {{-- Tabela de clientes --}}
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Profissional</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td>{{ $cliente->user->name }}</td>
                        <td class="text-center">
                        @if (auth()->check() && auth()->user()->nivel !== 'administrativo')
                            <a href="{{ route('abrir_ficha_cliente', $cliente->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-folder-open"></i> Ficha
                            </a>
                        @endif
                           <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum cliente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div class="d-flex justify-content-center">
        {{ $clientes->onEachSide(0)->links() }}
    </div>
</div>
@stop

@section('css')
    {{-- Adicione aqui estilos adicionais --}}
    <style>
        .btn-sm {
            padding: .25rem .5rem;
            font-size: .875rem;
        }
    </style>
@stop

@section('js')
    <script> console.log('Clientes page loaded!'); </script>
@stop
