<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
   // Lista todos os clientes
   public function index()
   {
       $clientes = Cliente::all();
       return view('Cadastro.Cliente.index', compact('clientes'));
   }

   // Mostra o formulário de criação de um novo cliente
   public function create()
   {
       $sexos = ['Masculino', 'Feminino', 'Não Escolha'];
       return view('Cadastro.Cliente.create', compact('sexos'));
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
           'sexo' => 'required|string|in:Masculino,Feminino,Não Escolha',
           'data_nascimento' => 'nullable|date',
       ]);

       $request['user_id'] = 1;
       Cliente::create($request->all());

       return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
   }

   // Mostra o formulário para editar um cliente
   public function edit(Cliente $cliente)
   {
       $sexos = ['Masculino', 'Feminino', 'Não Escolha'];
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
           'sexo' => 'required|string|in:Masculino,Feminino,Não Escolha',
           'data_nascimento' => 'nullable|date',
       ]);

       $request['user_id'] = 1;
       $cliente->update($request->all());

       return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
   }

   // Remove um cliente do banco de dados
   public function destroy(Cliente $cliente)
   {
       $cliente->delete();

       return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
   } 
}
