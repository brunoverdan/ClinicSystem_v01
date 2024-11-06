<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lancamento;
use App\Models\Servico;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class LancamentoController extends Controller
{
    public function index()
    {
        $lancamentos = Lancamento::with(['servico', 'user', 'cliente'])->get();
        return view('Movimentacao.Lancamento.index', compact('lancamentos'));
    }

    public function create()
    {
        $servicos = Servico::all();
        $clientes = User::where('nivel', 'cliente')->get();
        return view('Movimentacao.Lancamento.create', compact('servicos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servico_id' => 'required|exists:servicos,id',
            'user_id' => 'required|exists:users,id',
            'cliente_id' => 'required|exists:users,id',
            'data' => 'required|date',
            'desconto' => 'nullable|numeric',
            'arquivo' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'status' => 'required|in:lancamento,baixa',
        ]);

        $data = $request->all();

        // Upload do comprovante se existir
        if ($request->hasFile('arquivo')) {
            $data['arquivo'] = $request->file('arquivo')->store('comprovantes', 'public');
        }

        Lancamento::create($data);

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento criado com sucesso.');
    }

    public function edit(Lancamento $lancamento)
    {
        $servicos = Servico::all();
        $clientes = User::where('nivel', 'cliente')->get();
        return view('Movimentacao.Lancamento.edit', compact('lancamento', 'servicos', 'clientes'));
    }

    public function update(Request $request, Lancamento $lancamento)
    {
        $request->validate([
            'servico_id' => 'required|exists:servicos,id',
            'user_id' => 'required|exists:users,id',
            'cliente_id' => 'required|exists:users,id',
            'data' => 'required|date',
            'desconto' => 'nullable|numeric',
            'arquivo' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'status' => 'required|in:lancamento,baixa',
        ]);

        $data = $request->all();

        // Upload do comprovante se existir e substituir o anterior
        if ($request->hasFile('arquivo')) {
            if ($lancamento->arquivo) {
                Storage::disk('public')->delete($lancamento->arquivo);
            }
            $data['arquivo'] = $request->file('arquivo')->store('comprovantes', 'public');
        }

        $lancamento->update($data);

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento atualizado com sucesso.');
    }

    public function destroy(Lancamento $lancamento)
    {
        if ($lancamento->arquivo) {
            Storage::disk('public')->delete($lancamento->arquivo);
        }

        $lancamento->delete();

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento excluído com sucesso.');
    }
}
