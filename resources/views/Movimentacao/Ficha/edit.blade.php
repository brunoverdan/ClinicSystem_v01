@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Aba {{ $aba }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="container mt-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h2 class="mb-0">Editando Ficha do Cliente: {{ $cliente->nome }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('fichas.custom_update', ['cliente_id' => $cliente->id]) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Adicione este método para indicar uma atualização -->

                        <h2 class="mb-4">Perguntas</h2>

                        @foreach ($perguntas as $pergunta)
                            <div class="form-group">
                                <label for="pergunta_{{ $pergunta->id }}">{{ $pergunta->pergunta }}</label>

                                <!-- Verifica se existe uma resposta vinculada a esta pergunta -->
                                @php
                                    $resposta = $respostas->get($pergunta->id);
                                @endphp

                                @if ($pergunta->modelo == 'modelo_01')
                                    <div class="mb-2">
                                        <textarea type="text" name="perguntas[{{ $pergunta->id }}][resposta]" class="form-control" rows="3"
                                            placeholder="Especifique se necessário">{{ $resposta->resposta ?? '' }} ID = {{$pergunta->id}}</textarea>
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
                                            <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="sim" class="form-check-input" {{ ($resposta->resposta ?? '') == 'sim' ? 'checked' : '' }}>
                                            <label class="form-check-label">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="nao" class="form-check-input" {{ ($resposta->resposta ?? '') == 'nao' ? 'checked' : '' }}>
                                            <label class="form-check-label">Não</label>
                                        </div>
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                            value="modelo_02">
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                            value="{{ $pergunta->id }}">
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                            value="{{ $pergunta->pergunta }}">
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                            value="{{ $pergunta->aba }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="quais" class="form-label">Quais?</label>
                                        <input type="text" name="perguntas[{{ $pergunta->id }}][quais]"
                                            class="form-control" placeholder="Especifique se necessário"
                                            value="{{ $resposta->quais ?? '' }}">
                                    </div>
                                @elseif($pergunta->modelo == 'modelo_03')
                                    <div class="mt-2 d-inline-flex align-items-center">
                                        <div class="form-check me-3">
                                            <input type="checkbox" name="perguntas[{{ $pergunta->id }}][mais]"
                                                value="1" class="form-check-input"
                                                {{ $resposta->mais ?? 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">Mais</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input type="checkbox" name="perguntas[{{ $pergunta->id }}][menos]"
                                                value="1" class="form-check-input"
                                                {{ $resposta->menos ?? 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">Menos</label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input type="checkbox" name="perguntas[{{ $pergunta->id }}][direito]"
                                                value="1" class="form-check-input"
                                                {{ $resposta->direito ?? 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">Direito</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="perguntas[{{ $pergunta->id }}][esquerdo]"
                                                value="1" class="form-check-input"
                                                {{ $resposta->esquerdo ?? 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">Esquerdo</label>
                                        </div>
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]"
                                            value="modelo_03">
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]"
                                            value="{{ $pergunta->id }}">
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]"
                                            value="{{ $pergunta->pergunta }}">
                                        <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]"
                                            value="{{ $pergunta->aba }}">
                                    </div>
                                @endif


                                {{--                          
            <!-- Campo de texto para resposta -->
            <input type="text" name="perguntas[{{ $pergunta->id }}][resposta]"
                   class="form-control"
                   id="pergunta_{{ $pergunta->id }}"
                   value="{{ $resposta->resposta ?? '' }}">

            <!-- Outros campos com valores padrão -->
            <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="{{ $pergunta->modelo }}">
            <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">

            <!-- Exemplo de checkbox para 'mais' e 'menos' -->
            <div>
                <input type="checkbox" name="perguntas[{{ $pergunta->id }}][mais]" {{ ($resposta && $resposta->mais) ? 'checked' : '' }}> Mais
                <input type="checkbox" name="perguntas[{{ $pergunta->id }}][menos]" {{ ($resposta && $resposta->menos) ? 'checked' : '' }}> Menos
            </div>  --}}
                            </div>
                        @endforeach

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Salvar Ficha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @stop

    @section('css')
        {{-- Add here extra stylesheets --}}
        {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    @stop

    @section('js')
        <script>
            console.log("oi, todos direitos reservados para @CliniMaster!");
        </script>
    @stop
