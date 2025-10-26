<?php

use App\Http\Controllers\BairroController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
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
Route::post('/cidades', [CidadeController::class, 'store'])->name('cidades.store');

// Rotas Bairros
Route::get('/bairros', [BairroController::class, 'index'])->name('bairros.index');
Route::get('/bairros/create', [BairroController::class, 'create'])->name('bairros.create');
Route::get('/bairros/{id}', [BairroController::class, 'show'])->name('bairro.show');
Route::get('/bairros/{id}/edite', [BairroController::class, 'edit'])->name('bairros.edit');
Route::put('/bairros/{id}', [BairroController::class, 'update'])->name('bairros.update');
Route::delete('/bairros/{id}', [BairroController::class, 'destroy'])->name('bairros.destroy');
Route::post('/bairros', [BairroController::class, 'store'])->name('bairros.store');

// Rotas Escolas
Route::get('/escolas', [EscolaController::class, 'index'])->name('escolas.index');
Route::get('/escolas/create', [EscolaController::class, 'create'])->name('escolas.create');
Route::get('/escolas/{id}', [EscolaController::class, 'show'])->name('escola.show');
Route::get('/escolas/{id}/edite', [EscolaController::class, 'edit'])->name('escolas.edit');
Route::put('/escolas/{id}', [EscolaController::class, 'update'])->name('escolas.update');
Route::delete('/escolas/{id}', [EscolaController::class, 'destroy'])->name('escolas.destroy');
Route::post('/escolas', [EscolaController::class, 'store'])->name('escolas.store');

// Rotas Cardapios
Route::get('/cardapios', [CardapioController::class, 'index'])->name('cardapios.index');
Route::get('/cardapios/create', [CardapioController::class, 'create'])->name('cardapios.create');
Route::get('/cardapios/{id}', [CardapioController::class, 'show'])->name('cardapio.show');
Route::get('/cardapios/{id}/edite', [CardapioController::class, 'edit'])->name('cardapios.edit');
Route::put('/cardapios/{id}', [CardapioController::class, 'update'])->name('cardapios.update');
Route::delete('/cardapios/{id}', [CardapioController::class, 'destroy'])->name('cardapios.destroy');
Route::post('/cardapios', [CardapioController::class, 'store'])->name('cardapios.store');

// Rotas Usuários
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuario.show');
Route::get('/usuarios/{id}/edite', [UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

// Rotas Produtos
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produto.show');
Route::get('/produtos/{id}/edite', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
