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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                            role="tab" aria-controls="tab2" aria-selected="false">Avaliação Lombar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
                            role="tab" aria-controls="tab3" aria-selected="false">Evolução</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button"
                            role="tab" aria-controls="tab4" aria-selected="false">Arquivo</button>
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
                                            <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($cliente->data_nascimento)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                       

                        @if(count($respostas) > 0)
                            @include('Movimentacao.Ficha.edit')
                        @else
                            @include('Movimentacao.Ficha.create')
                        @endif
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                        @include('Movimentacao.FichaCliente.form_evolucao')

                    </div>
                    <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                        
                        @include('Movimentacao.File.index')

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
