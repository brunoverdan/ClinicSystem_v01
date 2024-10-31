@extends('adminlte::page')

@section('title', 'Clínicas')

@section('content_header')
    <h1 class="display-4">Lista de Serviços</h1>
@stop

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Serviços</h2>
        <a href="{{ route('servicos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Novo Serviço
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Serviço</th>
                    <th scope="col">Valores</th>
                    <th scope="col">Profissional</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicos as $servico)
                <tr>
                    <td>{{ $servico->servico }}</td>
                    <td>R$ {{ number_format($servico->valores, 2, ',', '.') }}</td>
                    <td>{{ $servico->user->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('servicos.edit', $servico->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')" title="Excluir">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="4" class="text-center">Total de Serviços: {{ count($servicos) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@stop

@section('css')
    {{-- Estilos personalizados --}}
    <style>
        h1.display-4 { font-weight: bold; }
        .table-responsive { overflow-x: auto; }
        .table th, .table td { vertical-align: middle; }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
