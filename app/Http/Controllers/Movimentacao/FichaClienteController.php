<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Evolucao;
use App\Models\File;
use App\Models\Medida;
use App\Models\Resposta;
use App\Models\ModeloPergunta;
use Illuminate\Http\Request;

class FichaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate(10);

        return view('Movimentacao.FichaCliente.index', compact('clientes'));
    }


    public function search(Request $request)
    {
        // Validação do campo de pesquisa
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Realiza a pesquisa por nome, telefone ou email
        $query = $request->input('query');
        $clientes = Cliente::where('nome', 'LIKE', "%{$query}%")
                    ->orWhere('telefone', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->paginate(10)
                    ->appends(['query' => $query]);


        // Retorna os resultados para a view
        return view('Movimentacao.FichaCliente.index', compact('clientes'));
    }

    public function abrir_ficha_cliente($id)
    {


        // Buscar o cliente pelo ID
        $cliente = Cliente::findOrFail($id);
        $files = File::where('cliente_id', $id)->get();
        $medidas = Medida::where('cliente_id', $id)->get();
        $evolucoes = Evolucao::where('cliente_id', $id)->get();
        //$perguntas = ModeloPergunta::orderBy('modelo', 'asc')->get();
        $respostas = Resposta::where('cliente_id', $id)->get();

        // Filtrar perguntas pelo user_id
        $perguntas = ModeloPergunta::where('user_id', auth()->user()->id)
        ->orderBy('modelo', 'asc')
        ->get();
        
             
        if (count($respostas) > 0) {
            $respostas = ModeloPergunta::with(['respostas' => function($query) use ($id) {
                $query->where('cliente_id', $id);
            }])
            ->where('user_id', auth()->user()->id)
            ->orderBy('modelo', 'asc')
            ->get();
        }

        

        return view('Movimentacao.FichaCliente.ficha_cliente', compact('cliente', 'files', 'evolucoes', 'perguntas', 'respostas', 'medidas'));
    }
}
