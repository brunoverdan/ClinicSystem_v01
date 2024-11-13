<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Clinica;
use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    // Lista todas as clínicas
    public function index()
    {
        $clinicas = Clinica::all();
        return view('Cadastro.Clinica.index', compact('clinicas'));
    }

    // Mostra o formulário de criação de uma nova clínica
    public function create()
    {
        return view('Cadastro.Clinica.create');
    }

    // Salva uma nova clínica no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string|max:2',
        ]);

        Clinica::create($request->all());

        return redirect()->route('clinicas.index')->with('success', 'Clínica criada com sucesso!');
    }

    // Mostra o formulário para editar uma clínica
    public function edit(Clinica $clinica)
    {
        return view('Cadastro.Clinica.edit', compact('clinica'));
    }

    // Atualiza uma clínica no banco de dados
    public function update(Request $request, Clinica $clinica)
    {
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string|max:2',
        ]);

        $clinica->update($request->all());

        return redirect()->route('clinicas.index')->with('success', 'Clínica atualizada com sucesso!');
    }

    // Remove uma clínica do banco de dados
    public function destroy(Clinica $clinica)
    {
        $clinica->delete();

        return redirect()->route('clinicas.index')->with('success', 'Clínica removida com sucesso!');
    }
}
