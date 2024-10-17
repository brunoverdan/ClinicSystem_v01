<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Evolucao;
use App\Models\Cliente;
use Illuminate\Http\Request;

class EvolucaoController extends Controller
{
    // Lista todas as evoluções
    public function index()
    {
        $evolucoes = Evolucao::with('cliente')->get();
        return view('Cadastro.Evolucao.index', compact('evolucoes'));
    }

    // Mostra o formulário de criação de uma nova evolução
    public function create()
    {
        $clientes = Cliente::all();
        return view('Cadastro.Evolucao.create', compact('clientes'));
    }

    // Salva uma nova evolução no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'nullable|string',
            'data' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Evolucao::create($request->all());

        return redirect()->back()->with('success', 'Arquivo salvo com sucesso!');
        //return redirect()->route('evolucoes.index')->with('success', 'Evolução registrada com sucesso!');
    }

    // Mostra o formulário para editar uma evolução
    public function edit(Evolucao $evolucao)
    {
        $clientes = Cliente::all();
        return view('Cadastro.Evolucao.edit', compact('evolucao', 'clientes'));
    }

    // Atualiza uma evolução no banco de dados
    public function update(Request $request, Evolucao $evolucao)
    {
        $request->validate([
            'descricao' => 'nullable|string',
            'data' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $evolucao->update($request->all());

        return redirect()->route('evolucoes.index')->with('success', 'Evolução atualizada com sucesso!');
    }

    // Remove uma evolução do banco de dados
    public function destroy($id)
    {
        $evolucao = Evolucao::find($id);
        $evolucao->delete();

        return redirect()->back()->with('danger', 'Arquivo excluido com sucesso!');
        //return redirect()->route('evolucoes.index')->with('success', 'Evolução removida com sucesso!');
    }
}
