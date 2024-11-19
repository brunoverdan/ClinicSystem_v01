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
    // Lista de agendamentos
    public function index()
    {
        $agendamentos = agendamento::with(['profissional', 'cliente', 'servico'])->get();
        return view('Movimentacao.Agendamento.index', compact('agendamentos'));
    }

    // Exibir o formulário de criação
    public function create()
    {
        
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $profissionais = User::find($userId);
        $clientes = Cliente::where('user_id', $userId)->get();
        $servicos = servico::where('user_id', $userId)->get();
       
        return view('Movimentacao.Agendamento.create', compact('profissionais', 'clientes', 'servicos'));
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

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso!');
    }

    // Exibir detalhes de um agendamento (opcional)
    public function show($id)
    {
        $agendamento = Agendamento::with(['profissional', 'cliente', 'servico'])->findOrFail($id);
        return view('Movimentacao.Agendamento.show', compact('agendamento'));
    }

    // Excluir um agendamento
    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
    }
}
