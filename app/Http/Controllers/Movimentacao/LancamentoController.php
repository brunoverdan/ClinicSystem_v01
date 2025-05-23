<?php

namespace App\Http\Controllers\Movimentacao;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Lancamento;
use App\Models\servico;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class LancamentoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        
        $lancamentos = Lancamento::with(['servico', 'user', 'cliente'])
        ->where('user_id', $userId)  // Filtra apenas os lançamentos do usuário logado
        ->get();

        return view('Movimentacao.Lancamento.index', compact('lancamentos'));
    }

    public function create()
    {
        
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $servicos = servico::where('user_id', $userId)->get();
        $clientes = User::where('nivel', 'cliente')->get();
        return view('Movimentacao.Lancamento.create', compact('servicos', 'clientes'));
    }

    public function store(Request $request)
    {

        
        $user = Auth::user();
        $request['user_id'] = $user ? $user->id : null;
        //$request['user_id'] = auth()->user()->id;
        $cliente_id = $request->input('cliente_id'); // Ou $request->cliente_id
        //$cliente_id = $cliente_id;
        //dd($cliente_id);
        //$cliente_id = $request->query('cliente_id');
       
        // Substitui a vírgula por um ponto no campo 'valor' para validar corretamente
        $request->merge([
            'valor' => str_replace(',', '.', $request->input('valor'))
        ]);

        $request->validate([
            'user_id' => 'required|integer',
            'servico_id' => 'required|integer',
            'data' => 'required|date',
            'valor' => 'required|numeric',
            'status' => 'required|string',
            'arquivo' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Defina as restrições do arquivo conforme necessário
        ]);

        // Prepare os dados para o lançamento
        $data = [
            'user_id' => $request->input('user_id'),
            'cliente_id' => $cliente_id,
            'servico_id' => $request->input('servico_id'),
            'data' => $request->input('data'),
            'valor' => $request->input('valor'),
            'status' => $request->input('status'),
            'observacao' => $request->input('status'),
        ];

        // Upload do comprovante, se existir
        if ($request->hasFile('arquivo')) {
            $data['arquivo'] = $request->file('arquivo')->store('comprovantes', 'public');
        }

        
       
        
            // Crie o lançamento com os dados
            $lancamento = Lancamento::create($data);
    
            // Verificar se a criação foi bem-sucedida
            if ($lancamento) {
                
                if($request['status'] == "pagamento" ){
        
                    return "cadastrou pagamento";
            
                   } else {
            
                    return redirect()->back()->with([
                        'sucesso' => 'Lançamento incluido com sucesso!',
                        'aba' => 'tab8' // Adiciona o parâmetro para manter a aba "Financeiro" ativa
                    ]);
            
                   }
            } 


    }

    public function edit(Lancamento $lancamento)
    {
        
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        //$userId = auth()->user()->id;
        $servicos = servico::where('user_id', $userId)->get();
        $clientes = User::where('nivel', 'cliente')->get();
        return view('Movimentacao.Lancamento.edit', compact('lancamento', 'servicos', 'clientes'));
    }

    public function update(Request $request, Lancamento $lancamento)
    {
        $request->validate([
            'servico_id' => 'required|exists:servicos,id',
            'user_id' => 'required|exists:users,id',
            'cliente_id' => 'required|exists:users,id',
            'data' => 'required|date',
            'desconto' => 'nullable|numeric',
            'arquivo' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'status' => 'required|in:lancamento,baixa',
        ]);

        $data = $request->all();

        // Upload do comprovante se existir e substituir o anterior
        if ($request->hasFile('arquivo')) {
            if ($lancamento->arquivo) {
                Storage::disk('public')->delete($lancamento->arquivo);
            }
            $data['arquivo'] = $request->file('arquivo')->store('comprovantes', 'public');
        }

        $lancamento->update($data);

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento atualizado com sucesso.');
    }

    public function destroy(Lancamento $lancamento)
    {
        if ($lancamento->arquivo) {
            Storage::disk('public')->delete($lancamento->arquivo);
        }

        $lancamento->delete();

        return redirect()->route('lancamentos.index')->with('success', 'Lançamento excluído com sucesso.');
    }
    
    public function indexRelatorio()
    {
        return "oi";
    }

    //era para retornar a funcion de cima indexRelatorio
    public function show(Request $request)
    {
        
        $user = Auth::user();
        $userId = $user ? $user->id : null; 
        $clientes = Cliente::where('user_id', $userId)->get();
        $usuarios = User::all();
        $lancamentos = Lancamento::where('user_id', $userId)->get();

        $query = Lancamento::query();

    if ($request->filled('data_inicial') && $request->filled('data_final')) {
        $query->whereBetween('data', [$request->data_inicial, $request->data_final]);
    }

    if ($request->filled('cliente_id')) {
        $query->where('cliente_id', $request->cliente_id);
    }

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    // Somas e dados para o relatório
    $lancamentos = $query->where('user_id', $userId)->get();
    $totalAtendimento = $lancamentos->where('status', 'atendimento')->sum('valor');
    $totalPagamento = $lancamentos->where('status', 'pagamento')->sum('valor');
    $diferenca = $totalPagamento - $totalAtendimento;
    $totalGeral = $lancamentos->sum('valor');

    return view('Movimentacao.Lancamento.relatorio', compact('clientes','usuarios','lancamentos', 'totalAtendimento', 'totalPagamento', 'diferenca', 'totalGeral'));

        //return view('Movimentacao.Lancamento.relatorio', compact('clientes','usuarios','lancamentos'));
    }

    public function relatorio(Request $request)
{
    // Usuário logado
    $user = Auth::user();

    // Filtro de clientes apenas do usuário logado
    $clientes = Cliente::where('user_id', $user->id)->get();

    // Query de lançamentos com filtro por cliente
    $query = Lancamento::where('user_id', $user->id);

    if ($request->filled('cliente_id')) {
        $query->where('cliente_id', $request->cliente_id);
    }

    // Dados do relatório
    $lancamentos = $query->get();
    $totalAtendimento = $lancamentos->where('status', 'atendimento')->sum('valor');
    $totalPagamento = $lancamentos->where('status', 'pagamento')->sum('valor');
    $diferenca = $totalPagamento - $totalAtendimento;
    $totalGeral = $lancamentos->sum('valor');

    return view('Movimentacao.Lancamento.relatorio', compact('lancamentos', 'clientes', 'totalAtendimento', 'totalPagamento', 'diferenca', 'totalGeral'));
}

    

    public function listaClientePagamento(Request $request)
{
    // Captura o usuário logado
    $user = Auth::user();

    // Configura a query base para buscar clientes apenas do usuário logado
    $query = Cliente::where('user_id', $user->id);

    // Filtro por nome do cliente
    if ($request->filled('cliente')) {
        $query->where('nome', 'like', '%' . $request->cliente . '%');
    }

    // Ordenação dos resultados (padrão: por nome)
    $clientes = $query->orderBy('nome')->get();

    // Retorna a view com os dados filtrados
    return view('Movimentacao.Lancamento.filtroClientePagamento', [
        'clientes' => $clientes,
    ]);
}


    public function cadastroPagamento($id)
    {
        
        //dd($id);
        
        $cliente = Cliente::findOrFail($id);
        $servicos = servico::where('user_id', $cliente->user_id)->get();
        $lancamentos = Lancamento::where('cliente_id', $id)
        ->select('data', 'servico_id', 'valor', 'observacao', 'arquivo')
        ->with('servico') // Assumindo que há uma relação `servico` para trazer o nome do serviço
        ->get();

        
       
        return view('Movimentacao.Lancamento.pagamento', compact('servicos', 'cliente', 'lancamentos'));
    }

    
}
