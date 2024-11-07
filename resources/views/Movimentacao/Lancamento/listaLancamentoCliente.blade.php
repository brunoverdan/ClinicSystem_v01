<div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Lançamentos</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data</th>
                <th>Serviço</th>
                <th>Valor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lancamentos as $lancamento)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($lancamento->data)->format('d/m/Y') }}</td>
                    <td>{{ $lancamento->servico->servico }}</td> <!-- Assumindo que existe uma relação entre Lancamento e Servico -->
                    <td>R$ {{ number_format($lancamento->valor, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $lancamento->status == 'atendimento' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ ucfirst($lancamento->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>