<div class="container">
    <h1>Editar Medida</h1>
    <form action="{{ route('medidas.update', $medida) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="number" name="peso" class="form-control" value="{{ $medida->peso }}" required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" name="data" class="form-control" value="{{ $medida->data }}" required>
        </div>
        <div class="form-group">
            <label for="cliente_id">Cliente ID</label>
            <input type="number" name="cliente_id" class="form-control" value="{{ $medida->cliente_id }}" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>