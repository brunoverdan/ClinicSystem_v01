<h1>Lançamentos de Serviços</h1>
    <a href="{{ route('lancamentos.create') }}">Novo Lançamento</a>

    <table>
        <thead>
            <tr>
                <th>Serviço</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Desconto</th>
                <th>Valor Final</th>
                <th>Status</th>
                <th>Arquivo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lancamentos as $lancamento)
                <tr>
                    <td>{{ $lancamento->servico->servico }}</td>
                    <td>{{ $lancamento->cliente->name }}</td>
                    <td>{{ $lancamento->data }}</td>
                    <td>{{ $lancamento->desconto }}</td>
                    <td>{{ $lancamento->valor_final }}</td>
                    <td>{{ ucfirst($lancamento->status) }}</td>
                    <td>
                        @if ($lancamento->arquivo)
                            <a href="{{ Storage::url($lancamento->arquivo) }}" target="_blank">Ver Comprovante</a>
                        @else
                            Sem Comprovante
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('lancamentos.edit', $lancamento->id) }}">Editar</a>
                        <form action="{{ route('lancamentos.destroy', $lancamento->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>