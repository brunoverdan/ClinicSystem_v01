@extends('adminlte::page')

@section('title', 'Relatório de Clientes')

@section('content_header')
    <h2 class="my-4 text-center">Relatório de Clientes</h2>
@stop

@section('content')
<div class="container">
    <!-- Filtro de pesquisa -->
    <form method="GET" action="{{ route('listaClientePagamento') }}" class="mb-4">
        <div class="card shadow-sm p-4">
            <div class="row align-items-center">
                <!-- Campo de busca por nome do cliente -->
                <div class="col-lg-10 col-md-8 col-sm-12">
                    <label for="cliente" class="form-label fw-bold">Buscar Cliente</label>
                    <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Digite o nome do cliente" value="{{ request('cliente') }}">
                </div>
                <!-- Botão de pesquisa -->
                <div class="col-lg-2 col-md-4 col-sm-12 mt-md-0 mt-3">
                    <button type="submit" class="btn btn-primary w-100">Pesquisar</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Tabela de resultados -->
    <div class="card shadow-sm p-4">
        <h5 class="fw-bold mb-3">Resultados</h5>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>
                            <a href="{{ route('cadastroPagamento', $cliente->id) }}" class="btn btn-sm btn-info">Cad.Pagamento</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Nenhum cliente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<style>
    .container {
        max-width: 900px;
        margin: 0 auto;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
@stop

@section('js')
<script>
    console.log("Relatório de Clientes carregado.");
</script>
@stop
