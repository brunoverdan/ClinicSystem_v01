@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Perguntas</h1>
@stop

@section('content')

<div class="container">
    <!-- Botão para adicionar nova pergunta -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Perguntas</h2>
        <a href="{{ route('modelo_perguntas.create') }}" class="btn btn-primary">Adicionar Nova Pergunta</a>
    </div>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabela de perguntas -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Pergunta</th>
                        <th>Modelo</th>
                        <th>Aba</th>
                        <th>Profissional</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modeloPerguntas as $pergunta)
                        <tr>
                            <td>{{ $pergunta->pergunta }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $pergunta->modelo)) }}</td> <!-- Modelo formatado -->
                            <td>{{ $pergunta->aba }}</td>
                            <td>{{ $pergunta->user->name ?? 'N/A' }}</td> <!-- Nome do usuário relacionado -->
                            <td>
                                <!-- Botões de ações -->
                                <a href="{{ route('modelo_perguntas.edit', $pergunta->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                
                                <form action="{{ route('modelo_perguntas.destroy', $pergunta->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop

@section('css')
    <!-- CSS personalizado -->
    <style>
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
    </style>
@stop

@section('js')
    <script> console.log("Página de lista de perguntas carregada!"); </script>
@stop
