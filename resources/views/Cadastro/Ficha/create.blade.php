@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <h1>Cadastrar Ficha de Cliente</h1>

    <form action="{{ route('fichas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="queixa">Queixa</label>
            <textarea name="queixa" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="habito">Hábito</label>
            <textarea name="habito" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="anamnesia">Anamnese</label>
            <textarea name="anamnesia" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" name="data" class="form-control">
        </div>

        <div class="form-group">
            <label for="cliente_id">ID do Cliente</label>
            <input type="number" name="cliente_id" class="form-control">
        </div>

        <hr>
        <h2>Perguntas</h2>

        @foreach($perguntas as $pergunta)
            <div class="form-group">
                <label>{{ $pergunta->pergunta }}</label>

                @if($pergunta->modelo == 'modelo_01')
                    <div>
                        <label>Resposta:</label><br>
                        <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="sim"> Sim
                        <input type="radio" name="perguntas[{{ $pergunta->id }}][resposta]" value="nao"> Não
                    </div>
                    <div>
                        <label>Quais?</label>
                        <input type="text" name="perguntas[{{ $pergunta->id }}][quais]" class="form-control">
                    </div>

                @elseif($pergunta->modelo == 'modelo_02')
                    <div>
                        <input type="checkbox" name="perguntas[{{ $pergunta->id }}][mais]" value="1"> Mais
                        <input type="checkbox" name="perguntas[{{ $pergunta->id }}][menos]" value="1"> Menos
                        <input type="checkbox" name="perguntas[{{ $pergunta->id }}][direito]" value="1"> Direito
                        <input type="checkbox" name="perguntas[{{ $pergunta->id }}][esquerdo]" value="1"> Esquerdo
                    </div>
                @endif
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Salvar Ficha</button>
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
