<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medida;
use Illuminate\Support\Carbon;

class MedidaController extends Controller
{
    public function index()
    {
        $medidas = Medida::all();

        $medidas->transform(function ($item) {
            $item->data = Carbon::parse($item->data)->format('d/m/Y');
            return $item;
        });

        return view('medidas.index', compact('medidas'));
    }


    public function create()
    {
        return view('medidas.create');
    }

    public function store(Request $request)
{
    
    //dd($request);
    $request['cliente_id'] = $request->query('cliente_id');
  
    // $request->validate([
    //     'peso' => 'required|numeric',
    //     'data' => 'required|date',
        
    // ]);

     // Substitui a vírgula por ponto no valor do peso, se necessário
     $peso = str_replace(',', '.', $request->input('peso'));

     // Atualiza o valor no request
     $request->merge(['peso' => $peso]);

     //dd($request);
     // Cria uma nova medida
     Medida::create($request->except('medida_id'));
     return redirect()->back()->with('success', 'Arquivo salvo com sucesso!');

    
}


    public function show(Medida $medida)
    {
        return view('medidas.show', compact('medida'));
    }

    

    public function destroy(Medida $medida)
    {
        $medida->delete();
        return redirect()->back()->with('danger', 'Arquivo excluida com sucesso!');
       
    }
}
