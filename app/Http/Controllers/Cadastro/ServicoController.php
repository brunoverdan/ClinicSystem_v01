<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\servico;
use App\Models\User;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $servicos = Servico::where('user_id', $userId)->get();
        return view('Cadastro.Servico.index', compact('servicos'));
    }

    public function create()
    {
        $user = auth()->user();

        // Apenas usuários administrativos veem a lista de profissionais
        $profissionais = $user->nivel === 'administrativo' ?
                         User::where('nivel', 'profissional')->get() : null;

        return view('Cadastro.Servico.create', compact('profissionais'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'valores' => 'required|numeric',
            'servico' => 'required',
            
        ]);

        // Se o usuário é administrativo, usa o user_id selecionado; caso contrário, usa o id do próprio usuário
        $data['user_id'] = $user->nivel === 'administrativo' ?
                           $request->user_id : $user->id;

        Servico::create($data);

        return redirect()->route('servicos.index');
    }

    public function edit(Servico $servico)
{
    $user = auth()->user();

    // Apenas usuários administrativos podem selecionar outro profissional
    $profissionais = $user->nivel === 'administrativo' ?
                     User::where('nivel', 'profissional')->get() : null;

    return view('Cadastro.Servico.edit', compact('servico', 'profissionais'));
}
public function update(Request $request, Servico $servico)
{
    $user = auth()->user();

    $data = $request->validate([
        'valores' => 'required|numeric',
        'servico' => 'required',
        
    ]);

    // Se o usuário é administrativo, pode alterar o user_id
    $data['user_id'] = $user->nivel === 'administrativo' ?
                       $request->user_id : $user->id;

    $servico->update($data);

    return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso!');
}

public function destroy(Servico $servico)
    {
        $servico->delete();
        return redirect()->route('servicos.index')->with('success', 'servico excluída com sucesso!');
    }
}
