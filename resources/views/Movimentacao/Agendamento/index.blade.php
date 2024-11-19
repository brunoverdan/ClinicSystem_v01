@extends('adminlte::page')

@section('title', 'Clínicas')

@section('content_header')
<h1>Lista de Abas</h1>
@stop

@section('content')

<div class="container">
    <h1>Lista de Agendamentos</h1>
    <a href="{{ route('agendamentos.create') }}" class="btn btn-primary mb-3">Novo Agendamento</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Profissional</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->id }}</td>
                    <td>{{ $agendamento->user->name }}</td>
                    <td>{{ $agendamento->cliente->nome }}</td>
                    <td>{{ $agendamento->servico->servico }}</td>
                    <td>{{ $agendamento->data_agendamento }}</td>
                    <td>{{ ucfirst($agendamento->status) }}</td>
                    <td>
                        <a href="{{ route('agendamentos.show', $agendamento->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                        <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi,Todo direitos reservados CliniMaster!"); </script>
@stop
