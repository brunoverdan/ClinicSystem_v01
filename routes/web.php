<?php

use App\Http\Controllers\Cadastro\ClienteController;
use App\Http\Controllers\Cadastro\ClinicaController;
use App\Http\Controllers\Cadastro\EvolucaoController;
use App\Http\Controllers\Cadastro\ModeloPerguntaController;
use App\Http\Controllers\Cadastro\FichaController;
use App\Http\Controllers\Cadastro\MedidaController;
use App\Http\Controllers\Cadastro\TermsController;
use App\Http\Controllers\Cadastro\AbaController;
use App\Http\Controllers\Cadastro\ServicoController;
use App\Http\Controllers\Cadastro\MedidaLabelController;
use App\Http\Controllers\Movimentacao\FichaClienteController;
use App\Http\Controllers\Movimentacao\FileController;
use App\Http\Controllers\Movimentacao\LancamentoController;
use App\Http\Controllers\Movimentacao\AgendamentoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // Página inicial
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Termos de Uso
    Route::prefix('terms')->group(function () {
        Route::get('/', [TermsController::class, 'show'])->name('terms.show');
        Route::post('/accept', [TermsController::class, 'accept'])->name('terms.accept');
    });

    //Route::any('abrir_ficha_cliente/{id}', 'App\Http\Controllers\Movimentacao\FichaClienteController@abrir_ficha_cliente')->name('abrir_ficha_cliente');

    // Cadastros
    Route::resources([
        'clinicas' => ClinicaController::class,
        'clientes' => ClienteController::class,
        'evolucoes' => EvolucaoController::class,
        'modelo_perguntas' => ModeloPerguntaController::class,
        'fichas' => FichaController::class,
        'medidas' => MedidaController::class,
        'abas' => AbaController::class,
        'servicos' => ServicoController::class,
        'medida_labels' => MedidaLabelController::class,
        'lancamentos' => LancamentoController::class,
        'agendamentos' => AgendamentoController::class,
    ]);

    

    // Rotas Adicionais de Clientes
   // Route::get('/lancamentos/indexRelatorio', [LancamentoController::class, 'indexRelatorio'])->name('lancamentos.indexRelatorio');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    //Route::get('clientes', [ClienteController::class, 'create'])->name('cliente.create');

    // Ficha Cliente
    //Route::any('abrir_ficha_cliente/{id}', 'App\Http\Controllers\Movimentacao\FichaClienteController@abrir_ficha_cliente')->name('abrir_ficha_cliente');
    Route::prefix('ficha_cliente')->group(function () {
        Route::get('/', [FichaClienteController::class, 'index'])->name('fichacliente.fichacliente');
        Route::get('/abrir/{id}', [FichaClienteController::class, 'abrir_ficha_cliente'])->name('abrir_ficha_cliente');
      
    });

    //Route::any('abrir_ficha_cliente/{id}', 'App\Http\Controllers\Movimentacao\FichaClienteController@abrir_ficha_cliente')->name('abrir_ficha_cliente');


   
    // Edição Personalizada de Fichas
    Route::prefix('fichas')->group(function () {
        Route::get('/edit/{cliente_id}/{aba}', [FichaController::class, 'edit'])->name('fichas.custom_edit');
        Route::put('/update/{cliente_id}', [FichaController::class, 'update'])->name('fichas.custom_update');
    });

    // Arquivos
    Route::prefix('files')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('files.index');
        Route::post('/', [FileController::class, 'store'])->name('files.store');
        Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');
    });

    // Pesquisa em Fichas
    Route::match(['get', 'post'], 'ficha/pesquisar', [FichaClienteController::class, 'search'])->name('fichas.search');

    // Lançamentos
    // Route::prefix('lancamentos')->group(function () {
    //     Route::post('/{cliente_id}', [LancamentoController::class, 'store'])->name('lancamentos.store');
    //     Route::get('/relatorio', [LancamentoController::class, 'relatorio'])->name('relatorio.lancamentos');
    //     Route::get('/indexRelatorio', [LancamentoController::class, 'indexRelatorio'])->name('lancamentos.indexRelatorio');
    // });

    // Lançamentos
// Route::resource('lancamentos', LancamentoController::class)->except(['store']);
// Route::post('/lancamentos/{cliente_id}', [LancamentoController::class, 'store'])->name('lancamentos.store');
// Route::get('/lancamentos/relatorio', [LancamentoController::class, 'relatorio'])->name('relatorio.lancamentos');
// Route::get('/lancamentos/indexRelatorio', [LancamentoController::class, 'indexRelatorio'])->name('lancamentos.indexRelatorio');

Route::resource('lancamentos', LancamentoController::class);
Route::get('/lancamentos/relatorio', [LancamentoController::class, 'relatorio'])->name('relatorio.lancamentos');
Route::get('/lancamentos/indexRelatorio', [LancamentoController::class, 'indexRelatorio'])->name('lancamentos.indexRelatorio');




    // Pagamentos
    Route::get('/listaClientePagamento', [LancamentoController::class, 'listaClientePagamento'])->name('listaClientePagamento');
    Route::prefix('pagamentos')->group(function () {
        Route::get('/cadastro/{id}', [LancamentoController::class, 'cadastroPagamento'])->name('cadastroPagamento');
    });
});
