@extends('adminlte::page')

@section('title', 'Adicionar Clínica')

@section('content_header')
    <h1>Criar Aba</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('abas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="aba">Nome da Aba:</label>
            <input type="text" class="form-control" id="aba" name="aba" required>
        </div>

        @if(Auth::user()->nivel === 'administrativo')
            <div class="form-group">
                <label for="user_id">Selecionar Usuário:</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="" disabled selected>Selecione um usuário</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        @endif

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('abas.index') }}" class="btn btn-secondary">Voltar</a>
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
