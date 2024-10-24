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
    // Captura o cliente_id vindo da query
    $cliente_id = $request->query('cliente_id');

    // Gravar as respostas
    foreach ($request->perguntas as $perguntaId => $respostaData) {
        $pergunta = ModeloPergunta::find($perguntaId);  // Busca a pergunta pelo ID

        try {
            // Grava a resposta no banco de dados, incluindo o pergunta_id
            $gravaResposta = Resposta::create([
                'tipo_modelo' => $pergunta->modelo,
                'pergunta' => $pergunta->pergunta,  // Texto da pergunta
                'pergunta_id' => $pergunta->id,     // Adiciona o pergunta_id
                'resposta' => $respostaData['resposta'] ?? null,
                'quais' => $respostaData['quais'] ?? null,
                'mais' => $respostaData['mais'] ?? 0,
                'menos' => $respostaData['menos'] ?? 0,
                'direito' => $respostaData['direito'] ?? 0,
                'esquerdo' => $respostaData['esquerdo'] ?? 0,
                'cliente_id' => $cliente_id,  // Cliente associado
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());  // Verifica erros
        }
    }

    return redirect()->back()->with('success', 'Perguntas gravadas com sucesso!');
}
   
   
    public function update(Request $request, $cliente_id)
{
    
    //dd($request->all()); // Verifica todos os dados recebidos
    
    // Recupera todas as perguntas enviadas do formulário
    $perguntas = $request->input('perguntas');

    // Itera sobre cada pergunta e processa as respostas
    foreach ($perguntas as $pergunta_id => $respostaData) {
       //dd($respostaData);
        // Verifica se o campo 'tipo_modelo' existe para evitar erros
        if (isset($respostaData['tipo_modelo'])) {
            //dd($respostaData['pergunta']);
            // Atualiza ou cria a resposta no banco de dados
            Resposta::updateOrCreate(
                [
                    'cliente_id' => $cliente_id,
                    'pergunta_id' => $pergunta_id // Adicione 'pergunta_id' para associar à pergunta correta
                ],
                [
                    'tipo_modelo' => $respostaData['tipo_modelo'], // Grava o tipo de modelo
                    'resposta' => $respostaData['resposta'] ?? "",
                    'quais' => $respostaData['quais'] ?? "",
                    'mais' => isset($respostaData['mais']) ? 1 : 0,
                    'menos' => isset($respostaData['menos']) ? 1 : 0,
                    'direito' => isset($respostaData['direito']) ? 1 : 0,
                    'esquerdo' => isset($respostaData['esquerdo']) ? 1 : 0,
                    'pergunta' => $respostaData['pergunta'] ?? "", // Adicione este campo
                ]
            );
        } else {
            // Caso o 'tipo_modelo' não esteja definido, pode gerar uma mensagem de erro ou log
            
            return redirect()->back()->with('error', 'Tipo de modelo não encontrado para uma das perguntas.');
        }
    }
    //dd($cliente_id);
    return redirect()->route('abrir_ficha_cliente', $cliente_id)->with('success', 'Perguntas alteradas com sucesso!');

    //return redirect()->back()->with('success', 'Perguntas gravadas com sucesso!');
}



    

}
