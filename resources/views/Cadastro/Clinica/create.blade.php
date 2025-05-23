@extends('adminlte::page')

@section('title', 'Criar Clínica')

@section('content_header')
    <h1>Criar Clínica</h1>
@stop

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clinicas.store') }}" method="POST">
        @csrf

        <!-- Informações Básicas -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5>Informações Básicas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome_fantasia">*Nome Fantasia:</label>
                            <input type="text" class="form-control" name="nome_fantasia">
                        </div>
                        <div class="form-group">
                            <label for="razao_social">Razão Social:</label>
                            <input type="text" class="form-control" name="razao_social">
                        </div>
                        <div class="form-group">
                            <label for="cpf_cnpj">CPF/CNPJ:</label>
                            <input type="text" class="form-control" name="cpf_cnpj">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefone">*Telefone:</label>
                            <input type="text" class="form-control" name="telefone">
                        </div>
                        <div class="form-group">
                            <label for="cidade">*Cidade:</label>
                            <input type="text" class="form-control" name="cidade">
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço:</label>
                            <input type="text" class="form-control" name="endereco">
                        </div>
                        <div class="form-group">
                            <label for="uf">*UF:</label>
                            <input type="text" class="form-control" name="uf" maxlength="2">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contato do Responsável Financeiro -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5>Contato do Responsável Financeiro</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="responsavel_financeiro_nome">Nome:</label>
                            <input type="text" class="form-control" name="responsavel_financeiro_nome">
                        </div>
                        <div class="form-group">
                            <label for="responsavel_financeiro_email">E-mail:</label>
                            <input type="email" class="form-control" name="responsavel_financeiro_email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="responsavel_financeiro_telefone">Telefone:</label>
                            <input type="text" class="form-control" name="responsavel_financeiro_telefone">
                        </div>
                        <div class="form-group">
                            <label for="responsavel_financeiro_whatsapp">WhatsApp:</label>
                            <input type="text" class="form-control" name="responsavel_financeiro_whatsapp">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responsável e Forma de Pagamento -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5>Forma de Pagamento</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="forma_pagamento">Forma de Pagamento:</label>
                            <input type="text" class="form-control" name="forma_pagamento">
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_pagamento_confirmacao">Data de Confirmação:</label>
                                <input type="date" class="form-control" name="data_pagamento_confirmacao">
                            </div>
                        
                            <div class="form-group">
                                <label for="valor_pagamento">Valor do Pagamento:</label>
                                <input type="number" class="form-control" name="valor_pagamento" step="0.01">
                            </div>
                        </div>
               
            </div>
        </div>

        <!-- Dados Bancários -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5>Dados Bancários</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="banco">Banco:</label>
                            <input type="text" class="form-control" name="banco">
                        </div>
                        <div class="form-group">
                            <label for="agencia">Agência:</label>
                            <input type="text" class="form-control" name="agencia">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="conta_corrente">Conta Corrente:</label>
                            <input type="text" class="form-control" name="conta_corrente">
                        </div>
                        <div class="form-group">
                            <label for="nome_conta">Nome da Conta:</label>
                            <input type="text" class="form-control" name="nome_conta">
                        </div>
                        <div class="form-group">
                            <label for="cpf_cnpj_conta">CPF/CNPJ da Conta:</label>
                            <input type="text" class="form-control" name="cpf_cnpj_conta">
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Criar</button>
            <a href="{{ route('clinicas.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
