@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <h1>Editar Pergunta</h1>

        <form action="{{ route('modelo_perguntas.update', $modeloPergunta->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if (auth()->user()->nivel == 'administrativo')
                <div class="form-group">
                    <label for="user_id">Usuário Profissional</label>
                    <select name="user_id" class="form-control" required>
                        <option value="" disabled selected>Selecione um usuário profissional</option>
                        @foreach ($profissionais as $profissional)
                            <option value="{{ $profissional->id }}"
                                {{ old('user_id', $modeloPergunta->user_id) == $profissional->id ? 'selected' : '' }}>
                                {{ $profissional->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @endif

            <div class="form-group">
                <label for="pergunta">Pergunta</label>
                <input type="text" name="pergunta" class="form-control"
                    value="{{ old('pergunta', $modeloPergunta->pergunta) }}" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo</label>
                <select name="modelo" class="form-control" required>
                    <option value="modelo_01" {{ $modeloPergunta->modelo == 'modelo_01' ? 'selected' : '' }}>Modelo 01
                    </option>
                    <option value="modelo_02" {{ $modeloPergunta->modelo == 'modelo_02' ? 'selected' : '' }}>Modelo 02
                    </option>
                    <option value="modelo_03" {{ $modeloPergunta->modelo == 'modelo_03' ? 'selected' : '' }}>Modelo 03
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="aba">aba</label>
                <select name="aba" class="form-control" required>
                    <option value="Cervical" {{ $modeloPergunta->aba == 'Cervical' ? 'selected' : '' }}>Cervical</option>
                    <option value="Lombar" {{ $modeloPergunta->aba == 'Lombar' ? 'selected' : '' }}>Lombar</option>
                </select>
            </div>

            <!-- Descrição dos Modelos -->
            <div class="mt-4">
                <h4>Descrição dos Modelos:</h4>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Modelo 01</h5>
                        <p class="card-text">Este modelo contém apenas a <strong>pergunta simples</strong>.</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Modelo 02</h5>
                        <p class="card-text">Este modelo contém uma pergunta com as alternativas de <strong>Sim</strong>,
                            <strong>Não</strong> e uma pergunta adicional como <strong>Quais</strong>.</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Modelo 03</h5>
                        <p class="card-text">Este modelo contém alternativas com sinais <strong>(+)</strong>,
                            <strong>(-)</strong>, e direções como <strong>Esquerda</strong> ou <strong>Direita</strong>.</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
