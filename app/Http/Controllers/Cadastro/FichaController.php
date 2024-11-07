<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Aba;
use App\Models\Cliente;
use App\Models\Evolucao;
use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\File;
use App\Models\Medida;
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

   
    public function edit($cliente_id, $aba)
{
    // Recebe o valor de 'aba' da requisição
        
    $aba = $aba;

    // Obtenha o usuário logado
    $usuarioId = auth()->user()->id;

    // Carrega as perguntas filtradas pelo 'aba' e 'user_id' do usuário
    $perguntas = ModeloPergunta::where('user_id', $usuarioId)
        ->where('aba', $aba)
        ->orderBy('modelo', 'asc')
        ->get();


    // Carrega todas as respostas vinculadas ao cliente e pergunta específica
    $respostas = Resposta::where('cliente_id', $cliente_id)
        ->whereIn('pergunta_id', $perguntas->pluck('id'))
        ->get()
        ->keyBy('pergunta_id'); // Associa respostas ao 'pergunta_id' para fácil acesso

    // Buscar o cliente pelo ID
    $cliente = Cliente::findOrFail($cliente_id);

    //dd($respostas);

    return view('Movimentacao.Ficha.edit', compact('cliente', 'perguntas', 'respostas', 'aba'));
    
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
                    'aba' => $respostaData['aba'] ?? 0,
                    'cliente_id' => $cliente_id,  // Cliente associado
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());  // Verifica erros
            }
        }

        // Buscar o cliente pelo ID
        $cliente = Cliente::findOrFail($cliente_id);
        $files = File::where('cliente_id', $cliente_id)->get();
        $medidas = Medida::where('cliente_id', $cliente_id)->get();
        $evolucoes = Evolucao::where('cliente_id', $cliente_id)->get();
        //$perguntas = ModeloPergunta::orderBy('modelo', 'asc')->get();
        $respostas = Resposta::where('cliente_id', $cliente_id)->get();

        // Filtrar perguntas pelo user_id

        $usuarioId = auth()->user()->id;

        $perguntas = ModeloPergunta::where('user_id', $usuarioId)
            ->orderBy('modelo', 'asc')
            ->get();


        $abas = Aba::where('user_id', $usuarioId)
            ->orderBy('aba', 'asc')
            ->get();


        if (count($respostas) > 0) {
            $respostas = ModeloPergunta::with(['respostas' => function ($query) use ($cliente_id) {
                $query->where('cliente_id', $cliente_id);
            }])
                ->where('user_id', auth()->user()->id)
                ->orderBy('modelo', 'asc')
                ->get();
        }

        $respostasPorAba = [];
        foreach ($abas as $aba) {
            $respostasPorAba[$aba->aba] = Resposta::where('cliente_id', $cliente_id)
                ->where('aba', $aba->aba)
                ->get();
        }


        return view('Movimentacao.FichaCliente.ficha_cliente', compact('cliente', 'files', 'evolucoes', 'perguntas', 'respostas', 'medidas', 'abas', 'respostasPorAba'));


        // return redirect()->back()->with('success', 'Perguntas gravadas com sucesso!');
    }


    

    public function update(Request $request, $cliente_id)
{
    // Recupera todas as perguntas enviadas do formulário
    $perguntas = $request->input('perguntas');

    // Itera sobre cada pergunta e processa as respostas
    foreach ($perguntas as $pergunta_id => $respostaData) {
        // Verifica se o campo 'tipo_modelo' existe
        if (!isset($respostaData['tipo_modelo'])) {
            return redirect()->back()->with('error', 'Tipo de modelo não encontrado para uma das perguntas.');
        }

        // Verifica se a pergunta existe
        if (!ModeloPergunta::where('id', $pergunta_id)->exists()) {
            return redirect()->back()->with('error', "A pergunta com ID $pergunta_id não foi encontrada.");
        }

        // Atualiza ou cria a resposta no banco de dados
        Resposta::updateOrCreate(
            [
                'cliente_id' => $cliente_id,
                'pergunta_id' => $pergunta_id,
            ],
            [
                'tipo_modelo' => $respostaData['tipo_modelo'],
                'resposta' => $respostaData['resposta'] ?? "",
                'quais' => $respostaData['quais'] ?? "",
                'mais' => isset($respostaData['mais']) ? 1 : 0,
                'menos' => isset($respostaData['menos']) ? 1 : 0,
                'direito' => isset($respostaData['direito']) ? 1 : 0,
                'esquerdo' => isset($respostaData['esquerdo']) ? 1 : 0,
                'pergunta' => $respostaData['pergunta'] ?? "",
                'aba' => $respostaData['aba'] ?? 0,
            ]
        );
    }

    // Buscar o cliente pelo ID
    $cliente = Cliente::findOrFail($cliente_id);
    $files = File::where('cliente_id', $cliente_id)->get();
    $medidas = Medida::where('cliente_id', $cliente_id)->get();
    $evolucoes = Evolucao::where('cliente_id', $cliente_id)->get();
    $respostas = Resposta::where('cliente_id', $cliente_id)->get();

    $usuarioId = auth()->user()->id;
    $perguntas = ModeloPergunta::where('user_id', $usuarioId)
        ->orderBy('modelo', 'asc')
        ->get();

    $abas = Aba::where('user_id', $usuarioId)
        ->orderBy('aba', 'asc')
        ->get();

    $respostasPorAba = [];
    foreach ($abas as $aba) {
        $respostasPorAba[$aba->aba] = Resposta::where('cliente_id', $cliente_id)
            ->where('aba', $aba->aba)
            ->get();
    }

    return view('Movimentacao.FichaCliente.ficha_cliente', compact('cliente', 'files', 'evolucoes', 'perguntas', 'respostas', 'medidas', 'abas', 'respostasPorAba'));
}

}
