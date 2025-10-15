<?php

use App\Http\Controllers\api\BairroController;
use App\Http\Controllers\api\CardapioController;
use App\Http\Controllers\api\CidadeController;
use App\Http\Controllers\api\EscolaController;
use App\Http\Controllers\api\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas cidades
Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
Route::get('/cidades/create', [CidadeController::class, 'create'])->name('cidades.create');
Route::get('/cidades/{id}', [CidadeController::class, 'show'])->name('cidade.show');
Route::get('/cidades/edit/{id}', [CidadeController::class, 'edit'])->name('cidades.edit');
Route::put('/cidades/{id}', [CidadeController::class, 'update'])->name('cidades.update');
Route::delete('/cidades/{id}', [CidadeController::class, 'destroy'])->name('cidades.destroy');

// Rotas Bairros
Route::get('/bairros', [BairroController::class, 'index'])->name('bairros.index');
Route::get('/bairros/create', [BairroController::class, 'create'])->name('bairros.create');
Route::get('/bairros/{id}', [BairroController::class, 'show'])->name('bairro.show');
Route::get('/bairros/{id}/edite', [BairroController::class, 'edit'])->name('bairros.edit');
Route::put('/bairros/{id}', [BairroController::class, 'update'])->name('bairros.update');
Route::delete('/bairros/{id}', [BairroController::class, 'destroy'])->name('bairros.destroy');

// Rotas Escolas
Route::get('/escolas', [EscolaController::class, 'index'])->name('escolas.index');
Route::get('/escolas/create', [EscolaController::class, 'create'])->name('escolas.create');
Route::get('/escolas/{id}', [EscolaController::class, 'show'])->name('escola.show');
Route::get('/escolas/{id}/edite', [EscolaController::class, 'edit'])->name('escolas.edit');
Route::put('/escolas/{id}', [EscolaController::class, 'update'])->name('escolas.update');
Route::delete('/escolas/{id}', [EscolaController::class, 'destroy'])->name('escolas.destroy');

// Rotas Cardapios
Route::get('/cardapios', [CardapioController::class, 'index'])->name('cardapios.index');
Route::get('/cardapios/create', [CardapioController::class, 'create'])->name('cardapios.create');
Route::get('/cardapios/{id}', [CardapioController::class, 'show'])->name('cardapio.show');
Route::get('/cardapios/{id}/edite', [CardapioController::class, 'edit'])->name('cardapios.edit');
Route::put('/cardapios/{id}', [CardapioController::class, 'update'])->name('cardapios.update');
Route::delete('/cardapios/{id}', [CardapioController::class, 'destroy'])->name('cardapios.destroy');

// Rotas Usuários
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuario.show');
Route::get('/usuarios/{id}/edite', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// Rotas Produtos
Route::get('/produtos', [UsuarioController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [UsuarioController::class, 'create'])->name('produtos.create');
Route::get('/produtos/{id}', [UsuarioController::class, 'show'])->name('produto.show');
Route::get('/produtos/{id}/edite', [UsuarioController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/{id}', [UsuarioController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{id}', [UsuarioController::class, 'destroy'])->name('produtos.destroy');