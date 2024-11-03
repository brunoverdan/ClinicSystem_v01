@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Aba {{$aba}}</h1>
@stop

@section('content')
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
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h1 class="mb-0">Questionário do Cliente</h1>
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
                            $resposta = $pergunta; // $pergunta já possui todos os dados da resposta atual
                        @endphp
                        
                        @if($pergunta->tipo_modelo == 'modelo_01')
                            <div class="mb-2">
                                <textarea type="text" name="perguntas[{{ $pergunta->id }}][resposta]" class="form-control" rows="3" placeholder="Especifique se necessário">{{ $resposta->resposta ?? '' }}  - - ID ={{$pergunta->pergunta_id}}</textarea>
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_01">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>
                        
                        @elseif($pergunta->tipo_modelo == 'modelo_02')
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
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][tipo_modelo]" value="modelo_02">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta_id]" value="{{ $pergunta->id }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][pergunta]" value="{{ $pergunta->pergunta }}">
                                <input type="hidden" name="perguntas[{{ $pergunta->id }}][aba]" value="{{ $pergunta->aba }}">
                            </div>

                            <div class="form-group">
                                <label for="quais" class="form-label">Quais?</label>
                                <input type="text" name="perguntas[{{ $pergunta->id }}][quais]" class="form-control" placeholder="Especifique se necessário" value="{{ $resposta->quais ?? '' }}">
                            </div>

                        @elseif($pergunta->tipo_modelo == 'modelo_03')
                            <div class="mt-2 d-inline-flex align-items-center">
                                <div class="form-check me-3">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][mais]" value="1" class="form-check-input" {{ ($resposta->mais ?? 0) ? 'checked' : '' }}>
                                    <label class="form-check-label">Mais</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][menos]" value="1" class="form-check-input" {{ ($resposta->menos ?? 0) ? 'checked' : '' }}>
                                    <label class="form-check-label">Menos</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][direito]" value="1" class="form-check-input" {{ ($resposta->direito ?? 0) ? 'checked' : '' }}>
                                    <label class="form-check-label">Direito</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="perguntas[{{ $pergunta->id }}][esquerdo]" value="1" class="form-check-input" {{ ($resposta->esquerdo ?? 0) ? 'checked' : '' }}>
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

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("oi, todos direitos reservados para @CliniMaster!"); </script>
@stop
