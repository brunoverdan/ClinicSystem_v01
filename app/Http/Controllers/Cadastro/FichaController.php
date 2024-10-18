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
        $cliente_id['cliente_id'] = $request->query('cliente_id');

        $request->validate([
            'queixa' => 'nullable|string',
            'habito' => 'nullable|string',
            'anamnesia' => 'nullable|string',
            'data' => 'nullable|date',
            'cliente_id' => 'required|integer',
        ]);

      
        $ficha = Ficha::create($request->only([
            'queixa', 
            'habito', 
            'anamnesia', 
            'data', 
            'cliente_id'
        ]));

        // Gravar as respostas
        foreach ($request->perguntas as $perguntaId => $respostaData) {
            $pergunta = ModeloPergunta::find($perguntaId);
            
            try {
                $gravaResposta = Resposta::create([
                    'tipo_modelo' => $pergunta->modelo,
                    'pergunta' => $pergunta->pergunta,
                    'resposta' => $respostaData['resposta'] ?? 0,
                    'quais' => $respostaData['quais'] ?? 0,
                    'mais' => $respostaData['mais'] ?? 0,
                    'menos' => $respostaData['menos'] ?? 0,
                    'direito' => $respostaData['direito'] ?? 0,
                    'esquerdo' => $respostaData['esquerdo'] ?? 0,
                    'cliente_id' => $cliente_id ?? 0,
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());  // Verifique se há algum erro
            }
        }

        return redirect()->back()->with('success', 'Arquivo salvo com sucesso!');
        //return redirect()->route('fichas.index')->with('success', 'Ficha criada com sucesso!');
    }
}
