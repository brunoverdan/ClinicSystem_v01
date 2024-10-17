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

    <form action="{{ route('evolucoes.store', ['cliente_id' => $cliente->id]) }}" method="POST">
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

<div class="container">
    <h3 class="my-4">Lista de Evoluções</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evolucoes as $evolucao)
            <tr>
                <td>{{ \Carbon\Carbon::parse($evolucao->data)->format('d/m/Y') }}</td>
                <td style="max-width: 100px; word-break: break-word;">{{ $evolucao->descricao }}</td>
                <td>
                    <a href="{{ route('evolucoes.edit', $evolucao->id) }}" class="btn btn-sm btn-warning">Editar</a>

                    <!-- Botão para abrir o modal de exclusão -->
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $evolucao->id }}">
                        Excluir
                    </button>

                    <!-- Modal de confirmação para excluir -->
                    <div class="modal fade" id="modal-delete-{{ $evolucao->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="modalLabel">Confirmação de Exclusão</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja excluir essa evolução?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('evolucoes.destroy', $evolucao->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>