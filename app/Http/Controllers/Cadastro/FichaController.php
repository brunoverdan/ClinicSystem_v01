<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\ModeloPergunta;
use App\Models\Resposta;


class FichaController extends Controller
{
    public function index()
   {
     return view('Cadastro.Ficha.index');
   }
    public function create()
    {
        $perguntas = ModeloPergunta::orderBy('modelo', 'asc')->get();
        return view('Cadastro.Ficha.create', compact('perguntas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'queixa' => 'nullable|string',
            'habito' => 'nullable|string',
            'anamnesia' => 'nullable|string',
            'data' => 'nullable|date',
            'cliente_id' => 'required|integer',
        ]);

        $ficha = Ficha::create($request->all());

        // Gravar as respostas
        foreach ($request->perguntas as $perguntaId => $respostaData) {
            $pergunta = ModeloPergunta::find($perguntaId);
            
            Resposta::create([
                'tipo_modelo' => $pergunta->modelo,
                'pergunta' => $pergunta->pergunta,
                'resposta' => $respostaData['resposta'] ?? null,
                'quais' => $respostaData['quais'] ?? null,
                'mais' => $respostaData['mais'] ?? null,
                'menos' => $respostaData['menos'] ?? null,
                'direito' => $respostaData['direito'] ?? null,
                'esquerdo' => $respostaData['esquerdo'] ?? null,
                'ficha_id' => $ficha->id,
            ]);
        }

        return redirect()->route('fichas.index')->with('success', 'Ficha criada com sucesso!');
    }
}
