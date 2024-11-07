@extends('adminlte::page')

@section('title', 'Adicionar Clínica')

@section('content_header')
    <h1>Criar Aba</h1>
@stop

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Novo Lançamento de Serviço</h2>

    <!-- Exibição de mensagens de erro -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de Lançamento -->
    <form action="{{ route('lancamentos.store', ['cliente_id' => $cliente->id]) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <!-- Seleção de Serviço -->
        <div class="mb-3">
            <label for="servico_id" class="form-label">Serviço:</label>
            <select name="servico_id" id="servico_id" class="form-select" required>
                <option value="">Selecione um Serviço</option>
                @foreach($servicos as $servico)
                    <option value="{{ $servico->id }}" data-valor="{{ $servico->valores }}">
                        {{ $servico->servico }} - R$ {{ number_format($servico->valores, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Por favor, selecione um serviço.</div>
        </div>

        <!-- Exibição do Valor -->
        <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            <div class="input-group">
                <span class="input-group-text">R$</span>
                <input type="text" name="valor" id="valor" class="form-control" readonly>
            </div>
        </div>

        <!-- Seleção de Data -->
        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" name="data" id="data" class="form-control" required>
            <div class="invalid-feedback">Por favor, insira uma data válida.</div>
        </div>

       <!-- Upload do Comprovante -->
       <div class="mb-3">
            <label for="arquivo" class="form-label">Comprovante de Pagamento:</label>
            <input type="file" name="arquivo" id="arquivo" accept=".jpg, .png, .pdf" class="form-control">
            <div class="form-text">Formatos permitidos: JPG, PNG, PDF.</div>
        </div>

        <!-- Observação -->
        <div class="mb-3">
            <label for="observacao" class="form-label">Observação</label>
            <input type="text" name="observacao" class="form-control" placeholder="Observação">
        </div>
        
        <!-- Status -->
        <input type="hidden" name="status" value="Pagamento">
        
        <!-- Botão de Envio -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Salvar Lançamento
            </button>
        </div>
    </form>
</div>

<!-- Script para Calcular o Valor Final e Preencher o Campo Valor -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const servicoSelect = document.getElementById('servico_id');
        const valorInput = document.getElementById('valor');
        const descontoInput = document.getElementById('desconto');
        const valorFinalLabel = document.getElementById('valor_final');

        function updateValor() {
            const servicoValor = parseFloat(servicoSelect.options[servicoSelect.selectedIndex].getAttribute('data-valor') || 0);
            valorInput.value = `${servicoValor.toFixed(2).replace('.', ',')}`;
            updateValorFinal();
        }

        function updateValorFinal() {
            const servicoValor = parseFloat(servicoSelect.options[servicoSelect.selectedIndex].getAttribute('data-valor') || 0);
            const desconto = parseFloat(descontoInput.value || 0);
            const valorFinal = servicoValor - desconto;

            valorFinalLabel.textContent = `Valor Final: R$ ${valorFinal.toFixed(2).replace('.', ',')}`;
        }

        servicoSelect.addEventListener('change', updateValor);
        descontoInput.addEventListener('input', updateValorFinal);

        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    });
</script>
@stop

@section('css')
    {{-- Adicione estilos personalizados aqui --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
