@extends('adminlte::page')

@section('title', 'Clínicas')

@section('css')
    <!-- Estilos adicionais -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css">
@endsection

@section('content')
    <div class="container">
        <h1 class="mb-4">Agendamentos</h1>
        <a href="{{ route('agendamentos.create') }}" class="btn btn-primary mb-3">Novo Agendamento</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Filtros Dinâmicos -->
        <!-- Filtros Dinâmicos -->
        <form method="GET" action="{{ route('agendamentos.index') }}" class="mb-3">
            <div class="row">
                <!-- Filtro Cliente -->
                <div class="col-md-4">
                    <label for="cliente" class="form-label">Cliente</label>
                    <select name="cliente" id="cliente" class="form-select select2">
                        <option value="">Selecione um cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ request('cliente') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro Data Início -->
                <div class="col-md-4">
                    <label for="data_inicio" class="form-label">Data Início</label>
                    <input type="date" name="data_inicio" id="data_inicio" class="form-control"
                        value="{{ request('data_inicio') }}">
                </div>

                <!-- Filtro Data Fim -->
                <div class="col-md-4">
                    <label for="data_fim" class="form-label">Data Fim</label>
                    <input type="date" name="data_fim" id="data_fim" class="form-control"
                        value="{{ request('data_fim') }}">
                </div>
            </div>

            <div class="row mt-3">
                <!-- Filtro Status -->
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Selecione um status</option>
                        <option value="agendado" {{ request('status') == 'agendado' ? 'selected' : '' }}>Agendado</option>
                        <option value="em atendimento" {{ request('status') == 'em atendimento' ? 'selected' : '' }}>Em
                            Atendimento</option>
                        <option value="concluído" {{ request('status') == 'concluído' ? 'selected' : '' }}>Concluído
                        </option>
                        <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>Cancelado
                        </option>
                    </select>
                </div>
            </div>

            <!-- Ações do Formulário -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Limpar Filtros</a>
            </div>
        </form>


        <!-- Tabela de Agendamentos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Cliente</th><th>Status</th>
                    <th>Etapa</th>
                    <th>Ficha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendamentos as $agendamento)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($agendamento->data_agendamento)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($agendamento->data_agendamento)->format('H:i') }}</td>
                        <td>{{ $agendamento->cliente->nome }}</td>
                        <td style="background-color: {{ $agendamento->color }};">{{ ucfirst($agendamento->status) }}</td>
                        <!-- alteracao Etapas -->
                        <td>

                            <form action="{{ route('agendamentos.status', $agendamento->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('POST')

                                @php
                                    // Definindo o próximo status baseado no status atual
                                    $proximoStatus = '';
                                    switch ($agendamento->status) {
                                        case 'agendado':
                                            $proximoStatus = 'Em Atendimento';
                                            break;
                                        case 'em atendimento':
                                            $proximoStatus = 'Concluído';
                                            break;
                                        case 'concluído':
                                            $proximoStatus = 'Status já finalizado'; // Não há próximo status
                                            break;
                                        case 'cancelado':
                                            $proximoStatus = 'Status já finalizado'; // Não há próximo status
                                            break;
                                    }
                                @endphp

                                <!-- Mostra o próximo status, a menos que o status já seja 'concluído' ou 'cancelado' -->
                                @if ($agendamento->status !== 'concluído' && $agendamento->status !== 'cancelado')
                                <button 
                                    class="btn btn-primary" 
                                    onclick="mudarStatus('{{ route('agendamentos.status', $agendamento->id) }}')">
                                    Mudar Status para: {{ $proximoStatus }}
                                </button>

                                @else
                                    <!-- Se o status for concluído ou cancelado, o botão não aparece -->
                                    <p class="bg-success text-white p-2 d-inline">Atendimento Concluído</p>
                                @endif
                            </form>

                        </td>
                        <!-- Ficha -->
                        <td class="text-center">
                                @if (auth()->check() && auth()->user()->nivel !== 'administrativo')
                                    <a href="{{ route('abrir_ficha_cliente', $agendamento->cliente->id ) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-folder-open"></i> Ficha
                                    </a>
                                @endif
                        </td>
                        <td>
                            <!-- Mudar Status -->

                            <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                        <!-- alteracao -->

                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Nenhum agendamento encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Calendário Visual -->
        <div id="calendar"></div>
    </div>
@endsection

@section('js')
    <!-- Scripts adicionais -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // FullCalendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($agendamentosCalendario), // Passar os agendamentos no formato adequado
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                eventClick: function(info) {
                    if (confirm('Deseja editar este agendamento?')) {
                        window.location.href = '/agendamentos/' + info.event.id + '/edit';
                    }
                },
                dateClick: function(info) {
                    if (confirm('Deseja criar um agendamento nesta data?')) {
                        window.location.href = '/agendamentos/create?data=' + info.dateStr;
                    }
                }
            });

            calendar.render();
        });

        function mudarStatus(url) {
            if (confirm('Tem certeza que deseja mudar o status?')) {
                var form = document.createElement("form");
                form.method = "POST";
                form.action = url;

                // Adicionando os campos necessários
                var csrfToken = document.createElement("input");
                csrfToken.type = "hidden";
                csrfToken.name = "_token";
                csrfToken.value = "{{ csrf_token() }}";
                form.appendChild(csrfToken);

                var methodField = document.createElement("input");
                methodField.type = "hidden";
                methodField.name = "_method";
                methodField.value = "POST";
                form.appendChild(methodField);

                // Enviando o formulário
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
