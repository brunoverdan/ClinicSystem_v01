<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Lista todos os clientes
    public function index()
    {
        //
        
    }

    // Mostra o formulário de criação de um novo cliente
    public function create()
    {
        $profissionais = User::where('nivel', 'profissional')->get();
        $sexos = ['Masculino', 'Feminino','Nao_Informar'];
        return view('Cadastro.Cliente.create', compact('sexos','profissionais'));
    }

    // Salva um novo cliente no banco de dados
    public function store(Request $request)
    {
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string|max:2',
            'sexo' => 'required|string|in:Masculino,Feminino,Nao_Informar',
            'data_nascimento' => 'nullable|date',
        ]);

        

        if( $userId = auth()->user()->nivel !== 'profissional')
        {
            $userId = $request->user_id;
            $descricaoBarraBusca = "Digite Nome, Telefone, E-mail ou Profissional...";
           
        }else {
            $request['user_id']= auth()->user()->id;
            $userId= auth()->user()->id;
            $descricaoBarraBusca = "Digite Nome, Telefone ou E-mail...";
        }


        Cliente::create($request->all());

        $clientes = Cliente::where('user_id', $userId)->paginate(10);

        return view('Movimentacao.FichaCliente.index', compact('clientes','descricaoBarraBusca'))
            ->with('success', session('success'));
    }

    // Mostra o formulário para editar um cliente
    public function edit(Cliente $cliente)
    {
        $sexos = ['Masculino', 'Feminino', 'Nao_Informar'];
        return view('Cadastro.Cliente.edit', compact('cliente', 'sexos'));
    }

    // Atualiza um cliente no banco de dados
    public function update(Request $request, Cliente $cliente)
    {
       
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cidade' => 'nullable|string',
            'uf' => 'nullable|string|max:2',
            'sexo' => 'required|string|in:Masculino,Feminino,Nao_Informar',
            'data_nascimento' => 'nullable|date',
        ]);

        
        if( $userId = auth()->user()->nivel !== 'profissional')
        {
            $userId = User::where('nivel', 'profissional')->first();
            $request['user_id'] = $userId->id;
            $descricaoBarraBusca = "Digite Nome, Telefone, E-mail ou Profissional...";

        }else {
            $request['user_id']= auth()->user()->id;
            $userId= auth()->user()->id;
            $descricaoBarraBusca = "Digite Nome, Telefone ou E-mail...";
        }
        
        $cliente->update($request->all());

        $clientes = Cliente::where('user_id', $userId)->paginate(10);

        return view('Movimentacao.FichaCliente.index', compact('clientes','descricaoBarraBusca'))
            ->with('success', session('success'));
        //return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    // Remove um cliente do banco de dados
    public function destroy(Cliente $cliente)
    {
       
        $cliente->delete();
          
        $id = $cliente->id;
        $userId = Cliente::find($id);
        $clientes = Cliente::where('user_id', $userId->user_id)->paginate(10);

        if( $userId = auth()->user()->nivel !== 'profissional')
        {
            $descricaoBarraBusca = "Digite Nome, Telefone, E-mail ou Profissional...";

        }else {
            $descricaoBarraBusca = "Digite Nome, Telefone ou E-mail...";
        }
        
        return view('Movimentacao.FichaCliente.index', compact('clientes','descricaoBarraBusca'))
        ->with('success', session('success'));
        
    }
}
