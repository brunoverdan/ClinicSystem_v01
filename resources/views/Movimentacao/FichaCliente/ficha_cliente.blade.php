@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ficha Cliente</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                            type="button" role="tab" aria-controls="tab1" aria-selected="true">Cliente</button>
                    </li>
                    {{--  @foreach ($perguntas->groupBy('aba') as $aba => $questions)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab{{ $loop->index + 2 }}-tab" data-bs-toggle="tab"
                                data-bs-target="#tab{{ $loop->index + 2 }}" type="button" role="tab"
                                aria-controls="tab{{ $loop->index + 2 }}" aria-selected="false">{{ ucfirst($aba) }}</button>
                        </li>
                    @endforeach  --}}
                    @php
                    {{$numtab = 1; }}
                    @endphp
                    @foreach ($abas as $aba)
                    @php
                    {{$numtab += 1; }}
                    @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab{{$numtab}}-tab" data-bs-toggle="tab" data-bs-target="#tab{{$numtab}}" type="button"
                            role="tab" aria-controls="tab{{$numtab}}" aria-selected="false">{{$aba->aba}}</button>
                    </li>
                    @endforeach  
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button"
                            role="tab" aria-controls="tab5" aria-selected="false">Medidas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab6-tab" data-bs-toggle="tab" data-bs-target="#tab6" type="button"
                            role="tab" aria-controls="tab6" aria-selected="false">Evolução</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab7-tab" data-bs-toggle="tab" data-bs-target="#tab7" type="button"
                            role="tab" aria-controls="tab7" aria-selected="false">Arquivo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ request('aba') == 'tab8' ? 'active' : '' }}" 
                                id="tab8-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#tab8" 
                                type="button"
                                role="tab" 
                                aria-controls="tab8" 
                                aria-selected="{{ request('aba') == 'tab8' ? 'true' : 'false' }}">
                            Financeiro
                        </button>
                    </li>
                    <li class="nav-item ms-auto">
                        <a href="#" class="nav-link text-muted"><i class="fa fa-gear"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div class="container mt-5">
                            <!-- Informações do Cliente -->
                            <div class="row">
                                <!-- Coluna 1 -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Informações do Cliente</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
                                            <p><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
                                            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
                                            <p><strong>Observação:</strong> {{ $cliente->observacao}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Coluna 2 -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Informações Adicionais</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Email:</strong> {{ $cliente->email }}</p>
                                            <p><strong>Cidade:</strong> {{ $cliente->cidade }}</p>
                                            <p><strong>Estado (UF):</strong> {{ $cliente->uf }}</p>
                                            <p><strong>Sexo:</strong> {{ $cliente->sexo }}</p>
                                            <p><strong>Data de Nascimento:</strong>
                                                {{ \Carbon\Carbon::parse($cliente->data_nascimento)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @php
                    $numtab = 1;
                @endphp

                @foreach ($abas as $aba)
                    @php
                        // Filtrar as perguntas relacionadas à aba atual
                        $questionsFiltered = $perguntas->where('aba', $aba->aba);
                        $responsesFiltered = $respostasPorAba[$aba->aba] ?? collect(); // Obter respostas para a aba atual ou coleção vazia
                        $numtab += 1;
                    @endphp

                    <div class="tab-pane fade" id="tab{{$numtab}}" role="tabpanel" aria-labelledby="tab{{$numtab}}-tab">
                        @if ($responsesFiltered->count() > 0)
                            @include('Movimentacao.Ficha.show', [
                                'perguntas' => $questionsFiltered,
                                'responsesFiltered' => $responsesFiltered
                            ])
                        @else
                            @include('Movimentacao.Ficha.create', ['perguntas' => $questionsFiltered])
                        @endif
                    </div>
                @endforeach


                    <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                        @include('Movimentacao.Medida.index')
                    </div>
                    <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                        @include('Movimentacao.FichaCliente.form_evolucao')

                    </div>
                    <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-tab">

                        @include('Movimentacao.File.index')

                    </div>
                    <div class="tab-pane fade {{ request('aba') == 'tab8' ? 'show active' : '' }}" id="tab8" role="tabpanel" aria-labelledby="tab8-tab">

                        @include('Movimentacao.Lancamento.create')
                        <hr>
                        @include('Movimentacao.Lancamento.listaLancamentoCliente')

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@stop
