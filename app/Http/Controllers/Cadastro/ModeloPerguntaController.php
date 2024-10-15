<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\ModeloPergunta;
use Illuminate\Http\Request;

class ModeloPerguntaController extends Controller
{
    public function index()
    {
        $modeloPerguntas = ModeloPergunta::all();
        return view('Cadastro.ModeloPergunta.index', compact('modeloPerguntas'));
    }

    public function create()
    {
        return view('Cadastro.ModeloPergunta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required|string|max:255',
            'modelo' => 'required|in:modelo_01,modelo_02',
        ]);

        ModeloPergunta::create($request->all());
        return redirect()->route('modelo_perguntas.index')->with('success', 'Pergunta criada com sucesso!');
    }

    public function edit(ModeloPergunta $modeloPergunta)
    {
        return view('Cadastro.ModeloPergunta.edit', compact('modeloPergunta'));
    }

    public function update(Request $request, ModeloPergunta $modeloPergunta)
    {
        $request->validate([
            'pergunta' => 'required|string|max:255',
            'modelo' => 'required|in:modelo_01,modelo_02',
        ]);

        $modeloPergunta->update($request->all());
        return redirect()->route('modelo_perguntas.index')->with('success', 'Pergunta atualizada com sucesso!');
    }

    public function destroy(ModeloPergunta $modeloPergunta)
    {
        $modeloPergunta->delete();
        return redirect()->route('modelo_perguntas.index')->with('success', 'Pergunta excluída com sucesso!');
    }
}
