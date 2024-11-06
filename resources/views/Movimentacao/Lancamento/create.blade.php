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

        <!-- Data -->
        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" name="data" id="data" class="form-control" required>
            <div class="invalid-feedback">Por favor, insira uma data válida.</div>
        </div>

        <!-- Desconto -->
        <div class="mb-3">
            <label for="desconto" class="form-label">Desconto:</label>
            <input type="number" name="desconto" id="desconto" step="0.01" value="0.00" class="form-control">
            <small class="form-text text-muted" id="valor_final">Valor Final: R$ 0,00</small>
        </div>

        <!-- Upload do Comprovante -->
        <div class="mb-3">
            <label for="arquivo" class="form-label">Comprovante de Pagamento:</label>
            <input type="file" name="arquivo" id="arquivo" accept=".jpg, .png, .pdf" class="form-control">
            <div class="form-text">Formatos permitidos: JPG, PNG, PDF.</div>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-select">
                <option value="lancamento">Lançamento</option>
                <option value="baixa">Baixa</option>
            </select>
        </div>

        <!-- Botão de Envio -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Salvar Lançamento
            </button>
        </div>
    </form>
</div>

<!-- Script para Calcular o Valor Final -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const servicoSelect = document.getElementById('servico_id');
        const descontoInput = document.getElementById('desconto');
        const valorFinalLabel = document.getElementById('valor_final');

        function updateValorFinal() {
            const servicoValor = parseFloat(servicoSelect.options[servicoSelect.selectedIndex].getAttribute('data-valor') || 0);
            const desconto = parseFloat(descontoInput.value || 0);
            const valorFinal = servicoValor - desconto;

            valorFinalLabel.textContent = `Valor Final: R$ ${valorFinal.toFixed(2).replace('.', ',')}`;
        }

        servicoSelect.addEventListener('change', updateValorFinal);
        descontoInput.addEventListener('input', updateValorFinal);

        // Bootstrap form validation
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

