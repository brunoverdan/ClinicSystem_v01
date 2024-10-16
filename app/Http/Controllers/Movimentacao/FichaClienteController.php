<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\File;
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
        $cliente = Cliente::find($id);
        $files = File::all();
        return view('Movimentacao.FichaCliente.ficha_cliente', compact('cliente', 'files'));
    }

}
