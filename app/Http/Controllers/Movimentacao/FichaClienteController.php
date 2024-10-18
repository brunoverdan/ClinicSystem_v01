<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Evolucao;
use App\Models\File;
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
        $clientes = Cliente::all();
        
       return view('Movimentacao.FichaCliente.index', compact('clientes'));
    }

    public function abrir_ficha_cliente($id)
    {
        
        
        // Buscar o cliente pelo ID
        $cliente = Cliente::findOrFail($id);
        $files = File::where('cliente_id', $id)->get();
        $evolucoes = Evolucao::where('cliente_id', $id)->get();
        $perguntas = ModeloPergunta::orderBy('modelo', 'asc')->get();
        $respostas = Resposta::where('cliente_id', $id)->get()->keyBy('pergunta_id');
        $perguntas = ModeloPergunta::all(); // Supondo que você tenha um modelo Pergunta
   


        return view('Movimentacao.FichaCliente.ficha_cliente', compact('cliente', 'files', 'evolucoes', 'perguntas', 'respostas'));
    }

}
