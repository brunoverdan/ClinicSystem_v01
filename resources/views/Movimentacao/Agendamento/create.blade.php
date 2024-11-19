@extends('adminlte::page')

@section('title', 'Novo Agendamento')

@section('content_header')
    <h1>Novo Agendamento</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Início do Formulário de Agendamento -->
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h3 class="card-title">Detalhes do Agendamento</h3>
                </div>
                <div class="card-body">
                    <!-- Verificação de Erros -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulário de Agendamento -->
                    <form action="{{ route('agendamentos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="profissional_id" class="form-label">Profissional</label>
                            <input type="text" class="form-control" value="{{ $profissionais->name}}" readonly>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        </div>

                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <select name="cliente_id" id="cliente_id" class="form-select select2" required>
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="mb-3">
                            <label for="servico_id" class="form-label">Serviço</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-cogs"></i></span>
                                <select name="servico_id" id="servico_id" class="form-select select2" required>
                                    <option value="">Selecione um serviço</option>
                                    @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->servico }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="mb-3">
                            <label for="data_agendamento" class="form-label">Data e Hora do Agendamento</label>
                            <input type="datetime-local" name="data_agendamento" id="data_agendamento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea name="observacoes" id="observacoes" class="form-control" placeholder="Adicione qualquer observação sobre o agendamento"></textarea>
                        </div>

                        <!-- Botões -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fim do Formulário -->
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Adicione aqui seus estilos personalizados --}}
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        /* Coloque o CSS personalizado aqui */
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        .form-select.is-invalid {
            border-color: #f44336;
            box-shadow: 0 0 5px rgba(244, 67, 54, 0.3);
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Página de agendamento carregada com sucesso.");
    </script>
@stop
