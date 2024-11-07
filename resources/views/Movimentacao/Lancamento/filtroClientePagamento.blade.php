@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Relatório de Clientes</h2>

    <!-- Mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filtro de pesquisa -->
    <form method="GET" action="{{ route('listaClientePagamento') }}" class="mb-4">
        <div class="row g-3 align-items-center">
            <!-- Campo de busca por nome do cliente -->
            <div class="col-md-6">
                <label for="cliente" class="form-label">Buscar Cliente</label>
                <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Digite o nome do cliente" value="{{ request('cliente') }}">
            </div>

            <!-- Filtro por profissional, apenas se o usuário logado não for 'profissional' -->
            @if(auth()->user()->nivel !== 'profissional')
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Selecionar Profissional</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">Todos os Profissionais</option>
                        @foreach ($profissionais as $profissional)
                            <option value="{{ $profissional->id }}" {{ request('user_id') == $profissional->id ? 'selected' : '' }}>
                                {{ $profissional->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Botão de pesquisa -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 mt-4">Pesquisar</button>
            </div>
        </div>
    </form>

    <!-- Campo de ordenação -->
    <div class="d-flex justify-content-between mb-3">
        <h5>Resultados</h5>
        <div>
            <label for="sort" class="form-label me-2">Ordenar por:</label>
            <select id="sort" class="form-select d-inline-block w-auto" onchange="sortTable()">
                <option value="name">Nome</option>
                <option value="data">Data</option>
            </select>
        </div>
    </div>

    <!-- Tabela de resultados -->
    <table class="table table-hover" id="resultadoTable">
        <thead>
            <tr>
                <th>Nome do Cliente</th>
                <th>Data</th>
                <th>Profissional</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->name }}</td>
                    <td>{{ $cliente->data }}</td>
                    <td>{{ $cliente->profissional->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script para ordenação da tabela -->
<script>
    function sortTable() {
        const sortOption = document.getElementById('sort').value;
        const table = document.getElementById('resultadoTable').getElementsByTagName('tbody')[0];
        const rows = Array.from(table.rows);

        rows.sort((a, b) => {
            const cellA = a.querySelector(`td:nth-child(${sortOption === 'name' ? 1 : 2})`).textContent.toLowerCase();
            const cellB = b.querySelector(`td:nth-child(${sortOption === 'name' ? 1 : 2})`).textContent.toLowerCase();
            return cellA.localeCompare(cellB);
        });

        rows.forEach(row => table.appendChild(row));
    }
</script>
@endsection
