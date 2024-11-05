<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h1 class="mb-0">Questionário do Cliente</h1>
        </div>
        <div class="card-body">
            <h2 class="mb-4">Perguntas</h2>

            @foreach ($perguntas as $pergunta)
                <div class="mb-4">
                    <h5 class="font-weight-bold">{{ $pergunta->pergunta }}</h5>

                    @php
                        // Procurar a resposta correspondente à pergunta na coleção filtrada de respostas
                        $resposta =
                            $responsesFiltered->where('pergunta_id', $pergunta->id)->first() ??
                            new \App\Models\Resposta();
                    @endphp

                    @if ($pergunta->modelo == 'modelo_01')
                        <p><strong>Resposta:</strong> {{ $resposta->resposta ?? 'Não especificado' }}</p>
                    @elseif($pergunta->modelo == 'modelo_02')
                        <p><strong>Resposta:</strong> {{ $resposta->resposta ?? 'Não especificado' }}</p>
                        <p><strong>Quais:</strong> {{ $resposta->quais ?? 'Não especificado' }}</p>
                    @elseif($pergunta->modelo == 'modelo_03')
                        <div class="mt-2 d-inline-flex align-items-center">
                            <span class="badge bg-primary me-3">{{ $resposta->mais ? 'Mais' : '' }}</span>
                            <span class="badge bg-primary me-3">{{ $resposta->menos ? 'Menos' : '' }}</span>
                            <span class="badge bg-primary me-3">{{ $resposta->direito ? 'Direito' : '' }}</span>
                            <span class="badge bg-primary">{{ $resposta->esquerdo ? 'Esquerdo' : '' }}</span>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="text-end mt-4">
                <a href="{{ route('fichas.custom_edit', ['cliente_id' => $cliente->id, 'aba' => $aba->aba]) }}"
                    class="btn btn-primary">
                    Editar Questionário
                </a>
            </div>


        </div>
    </div>
</div>
