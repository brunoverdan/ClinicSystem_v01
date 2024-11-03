<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Aba;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbaController extends Controller
{
    public function index()
    {
        // Verificar se o usuário logado é de nível 'administrativo'
        if (auth()->user()->nivel == 'administrativo') {
            // Se for administrativo, buscar os usuários com nível 'profissional'
            $abas = Aba::all();
            
        } else {
            // Se o usuário não for administrativo, não passamos nada para 'profissionais'
            $usuarioId = auth()->user()->id;
            $abas = Aba::where('user_id', $usuarioId)
            ->orderBy('aba', 'asc')
            ->get();
        }

        return view('Cadastro.Aba.index', compact('abas'));
    }

    public function create()
    {
        // Verifica o nível do usuário logado
        $userLevel = Auth::user()->nivel;

        // Obtém usuários profissionais se o nível for administrativo
        $users = ($userLevel === 'administrativo') ? User::where('nivel', 'profissional')->get() : [];

        return view('Cadastro.Aba.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Valida os dados
        $request->validate([
            'aba' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Cria a aba
        $aba = new Aba();
        $aba->aba = $request->aba;
        $aba->user_id = (Auth::user()->nivel === 'administrativo') ? $request->user_id : Auth::id();
        $aba->save();

        return redirect()->route('abas.index')->with('success', 'Aba criada com sucesso!');
    }

    public function edit(Aba $aba)
    {
        $userLevel = Auth::user()->nivel;
        $users = ($userLevel === 'administrativo') ? User::where('nivel', 'profissional')->get() : [];

        return view('Cadastro.Aba.edit', compact('aba', 'users'));
    }

    public function update(Request $request, Aba $aba)
    {
        $request->validate([
            'aba' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $aba->aba = $request->aba;
        $aba->user_id = (Auth::user()->nivel === 'administrativo') ? $request->user_id : Auth::id();
        $aba->save();

        return redirect()->route('abas.index')->with('success', 'Aba atualizada com sucesso!');
    }

    public function destroy(Aba $aba)
    {
        $aba->delete();
        return redirect()->route('abas.index')->with('success', 'Aba excluída com sucesso!');
    }
}
