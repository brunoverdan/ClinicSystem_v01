<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class TermsController extends Controller
{
    public function show()
    {
        return view('Cadastro.Terms.accept');
    }

    public function accept(Request $request)
    {
        $user = Auth::user();
        $user->terms_accepted = true;
        $user->accepted_at = now();
        $user->save();

        return redirect()->route('home')->with('success', 'Termo de aceite aceito com sucesso.');
    }
}
