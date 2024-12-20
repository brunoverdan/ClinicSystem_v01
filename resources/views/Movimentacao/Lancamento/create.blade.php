<div class="container mt-5">
    <h2 class="text-center mb-4">Novo Lançamento de Serviço</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lancamentos.store', ['cliente_id' => $cliente->id]) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <!-- Seleção do Serviço -->
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

        <!-- Valor -->
        <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            R$<input type="text" name="valor" id="valor" class="form-control" >
        </div>

        <!-- Data -->
        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" name="data" id="data" class="form-control" required>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const dataInput = document.getElementById('data');
                    const today = new Date().toISOString().split('T')[0];
                    dataInput.value = today;
                });
            </script>
            <div class="invalid-feedback">Por favor, insira uma data válida.</div>
        </div>

        {{--  <!-- Desconto -->
        <div class="mb-3">
            <label for="desconto" class="form-label">Desconto:</label>
            <input type="number" name="desconto" id="desconto" step="0.01" value="0.00" class="form-control">
            <small class="form-text text-muted" id="valor_final">Valor Final: R$ 0,00</small>
        </div>  --}}

        <!-- Upload do Comprovante -->
        <div class="mb-3">
            <label for="arquivo" class="form-label">Observação</label>
            <input type="text" name="observacao" class="form-control" placeholder="Observação">
        </div>
        
        <!-- Status -->
        <input type="hidden" name="status" value="Atendimento">
        
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
