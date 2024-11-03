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

    public function edit(Request $request)
    {
        $cliente_id = $request->input('cliente_id');
        $aba = $request->input('aba'); // Capturar o valor da aba

        $cliente = Cliente::findOrFail($cliente_id);

        // Filtrar as respostas com base no cliente e na aba
        $respostas = Resposta::where('cliente_id', $cliente_id)
            ->where('aba', $aba)
            ->get();

        if ($respostas->count() > 0) {
            // Obter as perguntas filtradas pelo usuário e pela aba
            $perguntas = ModeloPergunta::with(['respostasShow' => function ($query) use ($cliente_id) {
                $query->where('cliente_id', $cliente_id);
            }])
                ->where('user_id', auth()->user()->id)
                ->where('aba', $aba)
                ->orderBy('modelo', 'asc')
                ->get();
        } else {
            $perguntas = collect(); // Ou null, dependendo de como você quer tratar
        }

        return view('Movimentacao.Ficha.edit', compact('cliente', 'respostas', 'perguntas', 'aba'));
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
                        'aba' => $respostaData['aba'] ?? 0,

                    ]
                );
            } else {
                // Caso o 'tipo_modelo' não esteja definido, pode gerar uma mensagem de erro ou log
                return redirect()->back()->with('error', 'Tipo de modelo não encontrado para uma das perguntas.');
            }
        }
        //dd($cliente_id);
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

        //return redirect()->back()->with('success', 'Perguntas gravadas com sucesso!');
    }
}
