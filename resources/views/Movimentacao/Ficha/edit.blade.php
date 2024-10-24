<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h1 class="mb-0">Questionario do Cliente Edit</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('fichas.update', ['cliente_id' => $cliente->id]) }}" method="POST">
                @csrf
                @method('PUT') <!-- Adicione este método para indicar uma atualização -->
                
                <h2 class="mb-4">Perguntas</h2>

                @foreach($respostas as $pergunta)
                
                    <div class="form-group mb-4">
                        <label class="form-label">{{ $pergunta->pergunta }}</label>
                        
                        @php
                            // Se houver resposta, usa a primeira resposta. Caso contrário, cria uma resposta vazia.
                            $resposta = $pergunta->respostas->first() ?? new \App\Models\Resposta;
                        @endphp
                        
                        @if($pergunta->modelo == 'modelo_01')
                         
                            <div class="mb-2">
                                <textarea type="text" name="perguntas[{{ $pergunta->id }}][resposta]" class="form-control" rows="3" placeholder="Especifique se necessário">{{  $resposta->resposta  ?? '' }}</textarea>
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_01">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                            </div>

                        @elseif($pergunta->modelo == 'modelo_02')
                            <div class="mb-2">
                                <label class="form-label d-block">Resposta:</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="sim" class="form-check-input" {{ ($resposta->resposta ?? '') == 'sim' ? 'checked' : '' }}>
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_02">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                    <label class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="nao" class="form-check-input" {{ ($resposta->resposta ?? '') == 'nao' ? 'checked' : '' }}>
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_02">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                    <label class="form-check-label">Não</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quais" class="form-label">Quais?</label>
                                <input type="text" name="perguntas[{{ $pergunta->id }}][quais]" class="form-control" placeholder="Especifique se necessário" value="{{ $resposta->quais ?? '' }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_02">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                            </div>

                        @elseif($pergunta->modelo == 'modelo_03')
                            <div class="mt-2">
                                <div class="form-check">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][mais]" value="1" class="form-check-input" {{ ($resposta->mais ?? 0) ? 'checked' : '' }}>
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                    
                                    <label class="form-check-label">Mais</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][menos]" value="1" class="form-check-input" {{ ($resposta->menos ?? 0) ? 'checked' : '' }}>
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                    <label class="form-check-label">Menos</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][direito]" value="1" class="form-check-input" {{ ($resposta->direito ?? 0) ? 'checked' : '' }}>
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                    <label class="form-check-label">Direito</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][esquerdo]" value="1" class="form-check-input" {{ ($resposta->esquerdo ?? 0) ? 'checked' : '' }}>
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">

                                    <label class="form-check-label">Esquerdo</label>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Salvar Ficha</button>
                </div>
            </form>
        </div>
    </div>
</div>
