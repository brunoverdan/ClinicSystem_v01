@extends('adminlte::page')

@section('title', 'Relatório de Lançamentos')

@section('content_header')
    <h1 class="text-center mb-4">Relatório de Lançamentos</h1>
@stop

@section('content')
<div class="container">
    <!-- Filtro de Cliente -->
    <form method="GET" action="{{ route('relatorio.lancamentos') }}" class="card shadow-sm p-4 mb-5">
        <h4 class="mb-3">Filtrar por Cliente</h4>
        <div class="row align-items-end">
            <div class="col-md-8">
                <label for="cliente_id" class="form-label">Selecione o Cliente:</label>
                <select name="cliente_id" id="cliente_id" class="form-select">
                    <option value="">Todos os Clientes</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabela de Lançamentos -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Lançamentos</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Data</th>
                        <th>Serviço</th>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Observação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lancamentos as $lancamento)
                        <tr style="background-color: {{ $lancamento->status == 'atendimento' ? '#FFDDDD' : '#DDFFDD' }};">
                            <td>{{ \Carbon\Carbon::parse($lancamento->data)->format('d/m/Y') }}</td>
                            <td>{{ $lancamento->servico->servico }}</td>
                            <td>{{ $lancamento->cliente->nome }}</td>
                            <td>R$ {{ number_format($lancamento->valor, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($lancamento->status) }}</td>
                            <td>{{ $lancamento->observacao }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhum lançamento encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Resumo do Relatório -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Resumo do Relatório</h5>
        </div>
        <div class="card-body">
            <p><strong>Total Atendimento:</strong> R$ {{ number_format($totalAtendimento, 2, ',', '.') }}</p>
            <p><strong>Total Pagamento:</strong> R$ {{ number_format($totalPagamento, 2, ',', '.') }}</p>
            <p><strong>Total Geral:</strong> R$ {{ number_format($totalGeral, 2, ',', '.') }}</p>
            <p><strong>Diferença:</strong> R$ {{ number_format($diferenca, 2, ',', '.') }}</p>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
@stop

@section('js')
    <script> console.log("Relatório de Lançamentos carregado!"); </script>
@stop
