<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pergunta_mod_02;

class PerguntaMod02Controller extends Controller
{
    public function index()
    {
        $perguntas = pergunta_mod_02::all();
        return view('Cadastro.Pergunta_mod_02.index', compact('perguntas'));
    }

    public function create()
    {
        return view('Cadastro.Pergunta_mod_02.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required',
            'ativo' => 'required|integer',
        ]);

        pergunta_mod_02::create($request->all());

        return redirect()->route('pergunta_mod_02.index')->with('success', 'Pergunta criada com sucesso!');
    }

    public function show(PerguntaMod02 $perguntaMod02)
    {
        return view('Cadastro.Pergunta_mod_02.show', compact('perguntaMod02'));
    }

    public function edit(PerguntaMod02 $perguntaMod02)
    {
        return view('Cadastro.Pergunta_mod_02.edit', compact('perguntaMod02'));
    }

    public function update(Request $request, PerguntaMod02 $perguntaMod02)
    {
        $request->validate([
            'pergunta' => 'required',
            'ativo' => 'required|integer',
        ]);

        $perguntaMod02->update($request->all());

        return redirect()->route('pergunta_mod_02.index')->with('success', 'Pergunta atualizada com sucesso!');
    }

    public function destroy(PerguntaMod02 $perguntaMod02)
    {
        $perguntaMod02->delete();

        return redirect()->route('pergunta_mod_02.index')->with('success', 'Pergunta excluída com sucesso!');
    }
}
