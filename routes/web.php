<?php

use App\Http\Controllers\Cadastro\ClienteController;
use App\Http\Controllers\Cadastro\ClinicaController;
use App\Http\Controllers\Cadastro\EvolucaoController;
use App\Http\Controllers\Cadastro\ModeloPerguntaController;
use App\Http\Controllers\Cadastro\FichaController;
use App\Http\Controllers\Cadastro\MedidaController;
use App\Http\Controllers\Movimentacao\FichaClienteController;
use App\Http\Controllers\Movimentacao\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    //return redirect()->route('fichacliente.fichacliente');
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clinicas', ClinicaController::class);
Route::resource('clientes', ClienteController::class);
Route::get('cliente', [ClienteController::class, 'create'])->name('cliente.create');
Route::resource('evolucoes', EvolucaoController::class);
Route::get('/evolucoes/{evolucao}/edit', [EvolucaoController::class, 'edit'])->name('evolucoes.edit');
Route::resource('modelo_perguntas', ModeloPerguntaController::class);
Route::resource('fichas', FichaController::class);
Route::resource('medidas', MedidaController::class);

############# MOVIMENTAÇÃO ################

Route::resource('ficha_cliente', FichaClienteController::class);
Route::get('/ficha_cliente', [FichaClienteController::class, 'index'])->name('fichacliente.fichacliente');

Route::any('abrir_ficha_cliente/{id}', 'App\Http\Controllers\Movimentacao\FichaClienteController@abrir_ficha_cliente')->name('abrir_ficha_cliente');
Route::put('/fichas/{cliente_id}', [FichaController::class, 'update'])->name('fichas.update');

//File
Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::post('/files', [FileController::class, 'store'])->name('files.store');
Route::get('/files/download/{id}', [FileController::class, 'download'])->name('files.download');


######### Filtro ########

Route::post('/ficha/pesquisar', [FichaClienteController::class, 'search'])->name('fichas.search');

});