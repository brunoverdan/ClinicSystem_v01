@extends('adminlte::page')

@section('title', 'Editar Clínica')

@section('content_header')
    <h1>Editar Serviço</h1>
@stop

@section('content')
<div class="container">
    

    <form action="{{ route('servicos.update', $servico->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="servico">Serviço</label>
            <input type="text" name="servico" value="{{ $servico->servico }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="valores">Valores</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                </div>
                <input type="number" step="0.01" name="valores" value="{{ $servico->valores }}" step="0.01" 
               class="form-control" required maxlength="10" placeholder="Digite o valor">
            </div>
        </div>

        @if($profissionais)
            <div class="form-group">
                <label for="user_id">Selecionar Profissional</label>
                <select name="user_id" class="form-control">
                    @foreach($profissionais as $profissional)
                        <option value="{{ $profissional->id }}" {{ $servico->user_id == $profissional->id ? 'selected' : '' }}>
                            {{ $profissional->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@stop

@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

@stop


@section('js')
<script>
    $(document).ready(function(){
        $('#valores').mask('000,000.00', {reverse: true});
    });
</script>
    
@stop
