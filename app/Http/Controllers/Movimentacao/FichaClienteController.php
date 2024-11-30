<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\Aba;
use App\Models\Cliente;
use App\Models\Evolucao;
use App\Models\File;
use App\Models\Lancamento;
use App\Models\Medida;
use App\Models\MedidaLabel;
use App\Models\Resposta;
use App\Models\ModeloPergunta;
use App\Models\servico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FichaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($userId = auth()->user()->nivel !== 'profissional') {

            $userId = null;
            $descricaoBarraBusca = "Digite Nome, Telefone, E-mail ou Profissional...";
        } else {
            $userId = auth()->user()->id;
            $descricaoBarraBusca = "Digite Nome, Telefone ou E-mail...";
        }


        $clientes = Cliente::where('user_id', $userId)->paginate(10);

        return view('Movimentacao.FichaCliente.index', compact('clientes', 'descricaoBarraBusca'));
    }


    public function search(Request $request)
    {
        // Validação do campo de pesquisa
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Realiza a pesquisa por nome, telefone ou email
        $query = $request->input('query');

        if ($userId = auth()->user()->nivel !== 'profissional') {

            $descricaoBarraBusca = "Digite Nome, Telefone, E-mail ou Profissional...";
            $clientes = Cliente::where('nome', 'LIKE', "%{$query}%")
                ->orWhere('telefone', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhereHas('user', function ($queryUser) use ($query) {
                    $queryUser->where('name', 'LIKE', "%{$query}%");
                })
                ->paginate(10)
                ->appends(['query' => $query]);
        } else {

            $descricaoBarraBusca = "Digite Nome, Telefone ou E-mail...";
            $userId = auth()->id();

            $clientes = Cliente::where('user_id', $userId)
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('nome', 'LIKE', "%{$query}%")
                        ->orWhere('telefone', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%");
                })
                ->paginate(10)
                ->appends(['query' => $query]);
        }







        // Retorna os resultados para a view
        return view('Movimentacao.FichaCliente.index', compact('clientes', 'descricaoBarraBusca'));
    }

    public function abrir_ficha_cliente($id)
    {

        
        // Buscar o cliente pelo ID
        $cliente = Cliente::findOrFail($id);
        $files = File::where('cliente_id', $id)->get();
        $medidas = Medida::where('cliente_id', $id)->orderBy('data')->get();
        $evolucoes = Evolucao::where('cliente_id', $id)->get();
        $respostas = Resposta::where('cliente_id', $id)->get();
        
        
            // Filtro por Usuario

        if ($userId = auth()->user()->nivel !== 'profissional') {
            $userId = User::where('nivel', 'profissional')->first();
            $userId = $userId->id;
        } else {
            $userId = auth()->user()->id;
        }
        //dd($userId);
        // Filtrar perguntas pelo user_id
        $perguntas = ModeloPergunta::where('user_id', $userId)
            ->orderBy('modelo', 'asc')
            ->get();

        $abas = Aba::where('user_id', $userId)
            ->orderBy('aba', 'asc')
            ->get();

            
        if (count($respostas) > 0) {

            $respostas = ModeloPergunta::with(['respostas' => function ($query) use ($id) {
                $query->where('cliente_id', $id);
            }])
                ->where('user_id', $userId)
                ->orderBy('modelo', 'asc')
                ->get();
        }
       
       // Organizar as respostas por aba para fácil acesso na view
    $respostasPorAba = [];
    foreach ($abas as $aba) {
        $respostasPorAba[$aba->aba] = Resposta::where('cliente_id', $id)
            ->where('aba', $aba->aba)
            ->get();
    }
    
    $servicos = servico::where('user_id', $userId)->get();
    // Obtenha os lançamentos, ordenados pela data
    
    $lancamentos = Lancamento::where('cliente_id', $id)->orderBy('data', 'asc')->get();
    
    $medida_label = MedidaLabel::where('user_id', $userId)->firstOrFail();

   // dd("chegou aqui");
   
        return view('Movimentacao.FichaCliente.ficha_cliente', compact(
            'cliente',
            'files',
            'evolucoes',
            'perguntas',
            'respostas',
            'medidas',
            'abas',
            'respostasPorAba',
            'servicos',
            'lancamentos',
            'medida_label',
        ));
    }
}
