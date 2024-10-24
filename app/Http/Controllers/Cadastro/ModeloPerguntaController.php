<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\ModeloPergunta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ModeloPerguntaController extends Controller
{
    public function index()
{
    // Buscar todas as perguntas, ordenadas por 'modelo'
    $modeloPerguntas = ModeloPergunta::orderBy('modelo', 'asc')->get();

    // Verificar se o usuário logado é de nível 'administrativo'
    if (auth()->user()->nivel == 'administrativo') {
        // Se for administrativo, buscar os usuários com nível 'profissional'
        $profissionais = User::where('nivel', 'profissional')->get();
    } else {
        // Se o usuário não for administrativo, não passamos nada para 'profissionais'
        $profissionais = null;
    }

    // Passar as variáveis para a view
    return view('Cadastro.ModeloPergunta.index', compact('modeloPerguntas', 'profissionais'));
}

public function create()
{
    // Verificar se o usuário logado é de nível 'administrativo'
    if (auth()->user()->nivel == 'administrativo') {
        // Se for administrativo, buscar os usuários com nível 'profissional'
        $profissionais = User::where('nivel', 'profissional')->get();
    } else {
        // Se o usuário não for administrativo, não passamos nada para 'profissionais'
        $profissionais = null;
    }

    // Passar as variáveis para a view
    return view('Cadastro.ModeloPergunta.create', compact('profissionais'));
}


    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required|string|max:255',
            'modelo' => 'required|in:modelo_01,modelo_02,modelo_03',
        ]);

        ModeloPergunta::create($request->all());
        return redirect()->route('modelo_perguntas.index')->with('success', 'Pergunta criada com sucesso!');
    }

    public function edit(ModeloPergunta $modeloPergunta)
    {
        // Apenas para usuários administrativos, buscar profissionais
        if (auth()->user()->nivel == 'administrativo') {
            $profissionais = User::where('nivel', 'profissional')->get();
        } else {
            $profissionais = null;
        }

        return view('Cadastro.ModeloPergunta.edit', compact('modeloPergunta','profissionais'));
    }

    public function update(Request $request, ModeloPergunta $modeloPergunta)
    {
       
       
        $request->validate([
            'pergunta' => 'required|string|max:255',
            'modelo' => 'required|in:modelo_01,modelo_02,,modelo_03',
            'aba' => 'required|string',
            'user_id' => 'required|exists:users,id', // Valida o user_id
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
