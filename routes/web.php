<?php

use App\Http\Controllers\Cadastro\ClienteController;
use App\Http\Controllers\Cadastro\ClinicaController;
use App\Http\Controllers\Cadastro\EvolucaoController;
use App\Http\Controllers\Cadastro\PerguntaMod01Controller;
use App\Http\Controllers\Cadastro\PerguntaMod02Controller;
use App\Http\Controllers\Cadastro\ModeloPerguntaController;
use App\Http\Controllers\Cadastro\FichaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clinicas', ClinicaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('evolucoes', EvolucaoController::class);
Route::resource('pergunta_mod_01', PerguntaMod01Controller::class);
Route::resource('pergunta_mod_02', PerguntaMod02Controller::class);
Route::resource('modelo_perguntas', ModeloPerguntaController::class);
Route::resource('fichas', FichaController::class);
