<div class="container">
    <h1>Medidas</h1>
    <a href="{{ route('medidas.create') }}" class="btn btn-primary">Adicionar Medida</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Peso</th>
                <th>Data</th>
                <th>Cliente ID</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medidas as $medida)
            <tr>
                <td>{{ $medida->id }}</td>
                <td>{{ $medida->peso }}</td>
                <td>{{ $medida->data }}</td>
                <td>{{ $medida->cliente_id }}</td>
                <td>
                    <a href="{{ route('medidas.edit', $medida) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('medidas.destroy', $medida) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

