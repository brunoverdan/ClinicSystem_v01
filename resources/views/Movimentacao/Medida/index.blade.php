<div class="container">
    <h1>Gerenciar Medidas</h1>

    <!-- Formulário para criar/editar medida -->
    <form id="medidaForm" action="{{ route('medidas.store', ['cliente_id' => $cliente->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="medida_id" id="medida_id" value="">
        
        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="number" name="peso" id="peso" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" name="data" id="data" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success" id="submitButton">Cadastrar</button>
    </form>

    <hr>

    <!-- Tabela para listar medidas -->
    <h2>Lista de Medidas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Peso</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @if($medidas->isEmpty())
            <p>Nenhuma Medida cadastrado.</p>
        @else
            @foreach($medidas as $medida)
            <tr>
                <td>{{ $medida->peso }}</td>
                <td>{{ \Carbon\Carbon::parse($medida->data)->format('d/m/Y') }}</td>
                <td>
                    <form action="{{ route('medidas.destroy', $medida->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

