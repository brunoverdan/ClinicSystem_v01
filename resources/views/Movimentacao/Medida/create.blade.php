<div class="container">
    <h1>Cadastrar Medida</h1>
    <form action="{{ route('medidas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="number" name="peso" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" name="data" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cliente_id">Cliente ID</label>
            <input type="number" name="cliente_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>

