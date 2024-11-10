<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedidaLabel;
use App\Models\User;

class MedidaLabelController extends Controller
{
    public function index()
    {
        $medidaLabels = MedidaLabel::all();
        return view('Cadastro.MedidaLabel.index', compact('medidaLabels'));
    }

    public function create()
    {
        $profissionais = User::where('nivel', 'profissional')->get();
        return view('Cadastro.MedidaLabel.create', compact('profissionais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'medida_label' => 'required|string|max:255',
        ]);

        MedidaLabel::create($request->all());

        return redirect()->route('medida_labels.index')->with('success', 'Medida Label criada com sucesso!');
    }

    public function edit(MedidaLabel $medidaLabel)
    {
        $profissionais = User::where('nivel', 'profissional')->get();
        return view('Cadastro.MedidaLabel.edit', compact('medidaLabel', 'profissionais'));
    }

    public function update(Request $request, MedidaLabel $medidaLabel)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'medida_label' => 'required|string|max:255',
        ]);

        $medidaLabel->update($request->all());

        return redirect()->route('medida_labels.index')->with('success', 'Medida Label atualizada com sucesso!');
    }

    public function destroy(MedidaLabel $medidaLabel)
    {
        $medidaLabel->delete();

        return redirect()->route('medida_labels.index')->with('success', 'Medida Label excluída com sucesso!');
    }
}
