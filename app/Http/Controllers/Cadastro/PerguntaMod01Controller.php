<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pergunta_mod_01;

class PerguntaMod01Controller extends Controller
{
    public function index()
    {
        $perguntas = pergunta_mod_01::all();
        return view('Cadastro.Pergunta_mod_01.index', compact('perguntas'));
    }

    public function create()
    {
        return view('Cadastro.Pergunta_mod_01.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required',
            'ativo' => 'required|integer',
        ]);

        pergunta_mod_01::create($request->all());

        return redirect()->route('pergunta_mod_01.index')->with('success', 'Pergunta criada com sucesso!');
    }

    public function show(PerguntaMod01 $perguntaMod01)
    {
        return view('Cadastro.Pergunta_mod_01.show', compact('perguntaMod01'));
    }

    public function edit(PerguntaMod01 $perguntaMod01)
    {
        return view('Cadastro.Pergunta_mod_01.edit', compact('perguntaMod01'));
    }

    public function update(Request $request, PerguntaMod01 $perguntaMod01)
    {
        $request->validate([
            'pergunta' => 'required',
            'ativo' => 'required|integer',
        ]);

        $perguntaMod01->update($request->all());

        return redirect()->route('pergunta_mod_01.index')->with('success', 'Pergunta atualizada com sucesso!');
    }

    public function destroy(PerguntaMod01 $perguntaMod01)
    {
        $perguntaMod01->delete();

        return redirect()->route('pergunta_mod_01.index')->with('success', 'Pergunta excluída com sucesso!');
    }
}
