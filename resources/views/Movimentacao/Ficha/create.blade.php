<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h1 class="mb-0">Questionario do Cliente {{ $aba->aba }}</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('fichas.store', ['cliente_id' => $cliente->id]) }}" method="POST">
                @csrf

                <h2 class="mb-4">Perguntas</h2>
                @foreach ($perguntas as $pergunta)
                    <div class="form-group mb-4">
                        <label class="form-label">{{ $pergunta->pergunta }}</label>

                        @if ($pergunta->modelo == 'modelo_01')
                            <div class="mb-2">
                                <textarea type="text" name="perguntas[{{ $pergunta->id }}][resposta]" class="form-control" rows="3"
                                    placeholder="Especifique se necessário"></textarea>
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                    value="modelo_01">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                    value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                    value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                    value="{{ $pergunta->aba }}">
                            </div>
                        @elseif($pergunta->modelo == 'modelo_02')
                            <div class="mb-2">
                                <label class="form-label d-block">Resposta:</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]"
                                        value="sim" class="form-check-input">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                        value="modelo_02">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                        value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                        value="{{ $pergunta->pergunta }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                        value="{{ $pergunta->aba }}">
                                    <label class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]"
                                        value="nao" class="form-check-input">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                        value="modelo_02">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                        value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                        value="{{ $pergunta->pergunta }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                        value="{{ $pergunta->aba }}">
                                    <label class="form-check-label">Não</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quais" class="form-label">Quais?</label>
                                <input type="text" name="perguntas[{{ $pergunta->id }}][quais]" class="form-control"
                                    placeholder="Especifique se necessário">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                    value="modelo_02">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                    value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                    value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                    value="{{ $pergunta->aba }}">
                            </div>
                        @elseif($pergunta->modelo == 'modelo_03')
                            <div class="mt-2 d-inline-flex align-items-center">
                                <div class="form-check me-3">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][mais]" value="1"
                                        class="form-check-input">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                        value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                        value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                        value="{{ $pergunta->pergunta }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                        value="{{ $pergunta->aba }}">
                                    <label class="form-check-label">Mais</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][menos]"
                                        value="1" class="form-check-input">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                        value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                        value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                        value="{{ $pergunta->pergunta }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                        value="{{ $pergunta->aba }}">
                                    <label class="form-check-label">Menos</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][direito]"
                                        value="1" class="form-check-input">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                        value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                        value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                        value="{{ $pergunta->pergunta }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                        value="{{ $pergunta->aba }}">
                                    <label class="form-check-label">Direito</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][esquerdo]"
                                        value="1" class="form-check-input">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                        value="modelo_03">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                        value="{{ $pergunta->id }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                        value="{{ $pergunta->pergunta }}">
                                    <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                        value="{{ $pergunta->aba }}">
                                    <label class="form-check-label">Esquerdo</label>
                                </div>
                            </div>
                        @endif
                        <!-- Modelo 04 -->

                        @if ($pergunta->modelo == 'modelo_04')
                            <div class="mb-2">
                                <label class="form-label d-block">Resposta:</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="ata" class="form-check-input">
                                    <label class="form-check-label">Ata</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="baixa" class="form-check-input">
                                    <label class="form-check-label">Baixa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="normal" class="form-check-input">
                                    <label class="form-check-label">Normal</label>
                                </div>
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_04">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>

                            <div class="form-group">
                                <label for="medicacao" class="form-label">Medicação:</label>
                                <input type="text" name="perguntas[{{ $pergunta->id }}][medicacao]" class="form-control"
                                    placeholder="Especifique a medicação">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_04">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>
                        @endif


                        <!-- Fim Modelo 04 -->

                        <!-- Modelo 05 -->

                        @if ($pergunta->modelo == 'modelo_05')
                        <div class="form-group mb-2">
                            <label for="ha_quanto_tempo" class="form-label">Há quanto tempo:</label>
                            <input type="text" name="perguntas[{{ $pergunta->id }}][ha_quanto_tempo]" class="form-control"
                                placeholder="Especifique há quanto tempo">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_05">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                        </div>
                    
                        <div class="form-group mb-2">
                            <label for="especifique" class="form-label">Especifique:</label>
                            <input type="text" name="perguntas[{{ $pergunta->id }}][especifique]" class="form-control"
                                placeholder="Especifique se necessário">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_05">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                            <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                        </div>
                    @endif
                    

                        <!-- Fim Modelo 05 -->

                        <!-- Modelo 06 -->

                        @if ($pergunta->modelo == 'modelo_06')
                            <div class="form-group mb-2">
                                <label class="form-label d-block">Resposta:</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="sim" class="form-check-input">
                                    <label class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="nao" class="form-check-input">
                                    <label class="form-check-label">Não</label>
                                </div>
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_06">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>

                            <div class="form-group mb-2">
                                <label for="especifique" class="form-label">Especifique:</label>
                                <input type="text" name="perguntas[{{ $pergunta->id }}][especifique]" class="form-control"
                                    placeholder="Especifique se necessário">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_06">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>
                        @endif


                        <!-- Fim Modelo 06 -->

                        <!-- Modelo 07 -->

                        @if ($pergunta->modelo == 'modelo_07')
                            <div class="form-group mb-2">
                                <label class="form-label d-block">Resposta:</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="sim" class="form-check-input">
                                    <label class="form-check-label">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="nao" class="form-check-input">
                                    <label class="form-check-label">Não</label>
                                </div>
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_07">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>
                        @endif


                        <!-- Fim Modelo 07 -->

                    </div>
                @endforeach

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Salvar Ficha</button>
                </div>
            </form>
        </div>
    </div>
</div>
