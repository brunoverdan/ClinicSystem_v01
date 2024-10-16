<div class="container">
    <h1>Registrar Nova Evolução</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evolucoes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" class="form-control" name="data">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" name="descricao"></textarea>
        </div>
        
        
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>