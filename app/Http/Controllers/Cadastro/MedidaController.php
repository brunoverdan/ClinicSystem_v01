<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medida;

class MedidaController extends Controller
{
    public function index()
    {
        $medidas = Medida::all();
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
  
    $request->validate([
        'peso' => 'required|integer',
        'data' => 'required|date',
        
    ]);

    

    if ($request->medida_id) {
        // Atualiza a medida existente
        $medida = Medida::findOrFail($request->medida_id);
        $medida->update($request->all());
        return redirect()->back()->with('success', 'Arquivo salvo com sucesso!');
        //return redirect()->route('medidas.index')->with('success', 'Medida atualizada com sucesso!');
    } else {
        // Cria uma nova medida
        Medida::create($request->except('medida_id'));
        return redirect()->back()->with('success', 'Arquivo salvo com sucesso!');
        //return redirect()->route('medidas.index')->with('success', 'Medida cadastrada com sucesso!');
    }
}


    public function show(Medida $medida)
    {
        return view('medidas.show', compact('medida'));
    }

    public function edit(Medida $medida)
    {
        return view('medidas.edit', compact('medida'));
    }

    public function update(Request $request, Medida $medida)
    {
        $request->validate([
            'peso' => 'required|integer',
            'data' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $medida->update($request->all());
        return redirect()->route('medidas.index')->with('success', 'Medida atualizada com sucesso!');
    }

    public function destroy(Medida $medida)
    {
        $medida->delete();
        return redirect()->back()->with('danger', 'Arquivo excluida com sucesso!');
        //return redirect()->route('medidas.index')->with('success', 'Medida removida com sucesso!');
    }
}
