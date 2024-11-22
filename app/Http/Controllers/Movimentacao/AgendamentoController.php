<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\agendamento;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\servico;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    
    // nova index

    public function index(Request $request)
{
    // Obtém o usuário logado
    $user = Auth::user();

    // Filtros opcionais
    $query = Agendamento::query();

    // Se o usuário for um profissional, traz apenas os agendamentos deste profissional
    if ($user->nivel === 'profissional') {
        $query->where('user_id', $user->id);
    }

    // Se o usuário for um cliente, traz apenas os agendamentos deste cliente
    if ($user->nivel === 'cliente') {
        $query->where('cliente_id', $user->id);
    }

    // Filtro por cliente
    if ($request->has('cliente') && $request->cliente) {
        $query->where('cliente_id', $request->cliente);
    }

    // Filtro por intervalo de datas
    if ($request->has('data_inicio') && $request->data_inicio) {
        $query->whereDate('data_agendamento', '>=', $request->data_inicio);
    }

    if ($request->has('data_fim') && $request->data_fim) {
        $query->whereDate('data_agendamento', '<=', $request->data_fim);
    }

    // Filtro por status
    if ($request->has('status') && $request->status) {
        $query->where('status', $request->status);
    }

    // Recupera os agendamentos filtrados
    $agendamentos = $query->with(['cliente', 'user'])->get();

    // Formatar os agendamentos para o FullCalendar
    $agendamentosCalendario = $agendamentos->map(function ($agendamento) {
        $agendamento->color = $this->getStatusColor($agendamento->status);
        return $agendamento;
        // return [
        //     'id' => $agendamento->id,
        //     'title' => $agendamento->cliente->nome . ' - ' . $agendamento->user->name,
        //     'start' => $agendamento->data_agendamento . 'T' . $agendamento->horario,
        //     'end' => $agendamento->data_agendamento . 'T' . date('H:i:s', strtotime($agendamento->horario) + 3600), // 1h de duração
        //     'color' => $this->getStatusColor($agendamento->status),  // Cor do status
        // ];
    });

    // Dados para os filtros
    $clientes = $user->nivel === 'profissional' ? Cliente::where('user_id', $user->id)->get() : Cliente::all();

    //pegar a cor do botao



    // Retornar para a view
    return view('Movimentacao.Agendamento.index', compact('agendamentos', 'agendamentosCalendario', 'clientes'));
}



// Método auxiliar para definir cores do status
public static function getStatusColor($status)
{
    return match ($status) {
        'agendado' => '#A3C8FF', // Azul Pastel
        'em atendimento' => '#FFEB8C', // Amarelo Pastel
        'concluído' => '#A8E6A3', // Verde Pastel
        'cancelado' => '#FFB3B3', // Vermelho Pastel
        default => '#D1D1D1', // Cinza Pastel
    };
}



    // Exibir o formulário de criação
    public function create()
    {
        
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $profissionais = User::find($userId);
        $clientes = Cliente::where('user_id', $userId)->get();
        $servicos = servico::where('user_id', $userId)->get();
        $agendamentos = Agendamento::with('user', 'cliente') // Relacione se necessário
        ->orderBy('data_agendamento', 'desc')
        ->get();

       
        return view('Movimentacao.Agendamento.create', compact('profissionais', 'clientes', 'servicos', 'agendamentos'));
    }

    // Armazenar novo agendamento
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servico_id' => 'required|exists:servicos,id',
            'data_agendamento' => 'required|date',
        ]);

        Agendamento::create($request->all());


        //return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso!');
// Obtém o usuário logado
$user = Auth::user();

// Filtros opcionais
$query = Agendamento::query();

// Se o usuário for um profissional, traz apenas os agendamentos deste profissional
if ($user->nivel === 'profissional') {
    $query->where('user_id', $user->id);
}

// Recupera os agendamentos filtrados
$agendamentos = $query->with(['cliente', 'user'])->get();

// Formatar os agendamentos para o FullCalendar
$agendamentosCalendario = $agendamentos->map(function ($agendamento) {
    $agendamento->color = $this->getStatusColor($agendamento->status);
    return $agendamento;
    
});

// Dados para os filtros
$clientes = $user->nivel === 'profissional' ? Cliente::where('user_id', $user->id)->get() : Cliente::all();


// Retornar para a view
return view('Movimentacao.Agendamento.index', compact('agendamentos', 'agendamentosCalendario', 'clientes'));

    }

    // Exibir detalhes de um agendamento (opcional)
    public function show($id)
    {
        $agendamento = Agendamento::with(['user', 'cliente', 'servico'])->findOrFail($id);
        return view('Movimentacao.Agendamento.show', compact('agendamento'));
    }

    // Excluir um agendamento
    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
    }

    public function updateStatus(Request $request, Agendamento $agendamento)
{
    // Valida o status recebido
    $validated = $request->validate([
        'status' => ['required', 'in:agendado,em atendimento,concluído,cancelado'],
    ]);

    // Atualiza o status
    $agendamento->status = $validated['status'];
    $agendamento->save();

    // Redireciona com mensagem de sucesso
    return redirect()->route('agendamentos.index')->with('success', 'Status atualizado com sucesso.');
}

public function mudarStatus($id)
{
    // Buscar o agendamento pelo id
    $agendamento = Agendamento::findOrFail($id);

    // Definir a lógica para alterar o status do agendamento
    $novoStatus = $this->defineNovoStatus($agendamento->status);
    $agendamento->status = $novoStatus;
    $agendamento->save();

    // Redirecionar de volta para a página de agendamentos
    return redirect()->route('agendamentos.index')->with('status', 'Status alterado com sucesso!');
}

// Método auxiliar para definir o próximo status
private function defineNovoStatus($statusAtual)
{
    switch ($statusAtual) {
        case 'agendado':
            return 'em atendimento';
        case 'em atendimento':
            return 'concluído';
        case 'concluído':
            return 'cancelado';
        case 'cancelado':
            return 'agendado';
        default:
            return 'agendado';
    }
}



}
