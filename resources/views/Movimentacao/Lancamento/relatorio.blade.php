@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')
<div class="container">
    <h1>Relatório de Lançamentos</h1>

    <!-- Filtros -->
    <form method="GET" action="{{ route('relatorio.lancamentos') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label>Data Inicial:</label>
                <input type="date" name="data_inicial" class="form-control" value="{{ request('data_inicial') }}">
            </div>
            <div class="col-md-3">
                <label>Data Final:</label>
                <input type="date" name="data_final" class="form-control" value="{{ request('data_final') }}">
            </div>
            <div class="col-md-3">
                <label>Cliente:</label>
                <select name="cliente_id" class="form-control">
                    <option value="">Todos</option>
                    <!-- Carregar opções de clientes -->
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Usuário:</label>
                <select name="user_id" class="form-control">
                    <option value="">Todos</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ request('user_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
    </form>

    <!-- Tabela de Lançamentos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Serviço</th>
                <th>Cliente</th>
                <th>Usuário</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Observação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lancamentos as $lancamento)
                <tr style="background-color: {{ $lancamento->status == 'atendimento' ? '#FFDDDD' : '#DDFFDD' }}">
                    <td>{{ \Carbon\Carbon::parse($lancamento->data)->format('d/m/Y') }}</td>
                    <td>{{ $lancamento->servico->servico}}</td>
                    <td>{{ $lancamento->cliente->nome }}</td>
                    <td>{{ $lancamento->user->name }}</td>
                    <td>R$ {{ number_format($lancamento->valor, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($lancamento->status) }}</td>
                    <td>{{ $lancamento->observacao }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Resumo dos Valores -->
    <div class="mt-4">
        <h4>Resumo:</h4>
        <p>Total Atendimento: R$ {{ number_format($totalAtendimento, 2, ',', '.') }}</p>
        <p>Total Pagamento: R$ {{ number_format($totalPagamento, 2, ',', '.') }}</p>
        <p>Total Geral: R$ {{ number_format($totalGeral, 2, ',', '.') }}</p>
        <p>Diferença: R$ {{ number_format($diferenca, 2, ',', '.') }}</p>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
