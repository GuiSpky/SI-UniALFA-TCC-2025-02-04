<?php

use App\Http\Controllers\BairroController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\ItemProdutoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Inclui as rotas de autenticação do Breeze (login, registro, etc.)
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::fallback(function () {
        return redirect()->route('dashboard')->with('error', 'Página não encontrada.');
    });

    // Rota do Dashboard: Acessível para TODOS os usuários logados.
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas de Perfil: Acessível para TODOS os usuários logados.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // == NÍVEL GERENTE ==
    // Apenas Gerentes (cargo 1) podem acessar estas rotas.
    Route::middleware('role:gerente')->group(function () {
        // Rotas Bairros
        Route::get('/bairros', [BairroController::class, 'index'])->name('bairros.index');
        Route::get('/bairros/create', [BairroController::class, 'create'])->name('bairros.create');
        Route::get('/bairros/{id}', [BairroController::class, 'show'])->name('bairro.show');
        Route::get('/bairros/{id}/edite', [BairroController::class, 'edit'])->name('bairros.edit');
        Route::put('/bairros/{id}', [BairroController::class, 'update'])->name('bairros.update');
        Route::delete('/bairros/{id}', [BairroController::class, 'destroy'])->name('bairros.destroy');
        Route::post('/bairros', [BairroController::class, 'store'])->name('bairros.store');
        // Rotas cidades
        Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
        Route::get('/cidades/create', [CidadeController::class, 'create'])->name('cidades.create');
        Route::get('/cidades/{id}', [CidadeController::class, 'show'])->name('cidade.show');
        Route::get('/cidades/edit/{id}', [CidadeController::class, 'edit'])->name('cidades.edit');
        Route::put('/cidades/{id}', [CidadeController::class, 'update'])->name('cidades.update');
        Route::delete('/cidades/{id}', [CidadeController::class, 'destroy'])->name('cidades.destroy');
        Route::post('/cidades', [CidadeController::class, 'store'])->name('cidades.store');
        // Rotas Usuários
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
        Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuario.show');
        Route::get('/usuarios/{id}/edite', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
        Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
        // Rotas Estoque
        Route::get('/estoque/create', [ItemProdutoController::class, 'create'])->name('itemProdutos.create');
        Route::get('/estoque/{id}/edite', [ItemProdutoController::class, 'edit'])->name('itemProdutos.edit');
        Route::put('/estoque/{id}', [ItemProdutoController::class, 'update'])->name('itemProdutos.update');
        Route::delete('/estoque/{id}', [ItemProdutoController::class, 'destroy'])->name('itemProdutos.destroy');
        Route::post('/estoque', [ItemProdutoController::class, 'store'])->name('itemProdutos.store');

        // Rotas Escolas
        Route::get('/escolas/{id}/edite', [EscolaController::class, 'edit'])->name('escolas.edit');
        Route::put('/escolas/{id}', [EscolaController::class, 'update'])->name('escolas.update');
        Route::delete('/escolas/{id}', [EscolaController::class, 'destroy'])->name('escolas.destroy');
        Route::post('/escolas', [EscolaController::class, 'store'])->name('escolas.store');

        // Rotas Relatório
        Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
        Route::get('/relatorios/resultado', [RelatorioController::class, 'gerar'])->name('relatorios.resultado');
        Route::post('/relatorios', [RelatorioController::class, 'store'])->name('relatorios.store');

        //Rota Produto
        Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
        Route::get('/produtos/{id}/edite', [ProdutoController::class, 'edit'])->name('produtos.edit');
        Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
        Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
        Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    });

    // == NÍVEL COZINHEIRO-CHEFE ==
    // Gerentes (1) e Cozinheiros-Chefes (2) podem acessar.
    // (Não há rotas exclusivas para este nível no momento, mas a estrutura está aqui)
    Route::middleware('role:gerente,cozinheiro-chefe')->group(function () {
        // Rotas Consumos
        Route::get('/consumos', [ConsumoController::class, 'index'])->name('consumos.index');
        Route::get('/consumos/create', [ConsumoController::class, 'create'])->name('consumos.create');
        Route::post('/consumos', [ConsumoController::class, 'store'])->name('consumos.store');
        Route::get('/consumos/{id}', [ConsumoController::class, 'show'])->name('consumos.show');

        // Rotas Pedidos
        Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
        Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
        Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
        Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
        Route::resource('pedidos', PedidoController::class);
        Route::put('pedidos/{id}/enviar', [PedidoController::class, 'enviar'])->name('pedidos.enviar');
        Route::put('pedidos/{id}/recebido', [PedidoController::class, 'recebido'])->name('pedidos.recebido');
        Route::put('pedidos/{id}/confirmado', [PedidoController::class, 'confirmado'])->name('pedidos.confirmado');
    });

    // == NÍVEL NUTRICIONISTA ==
    // Gerentes (1), Cozinheiros-Chefes (2) e Nutricionistas (4) podem acessar.
    Route::middleware('role:gerente,cozinheiro-chefe,nutricionista')->group(function () {
        // Rotas Escolas
        Route::get('/escolas', [EscolaController::class, 'index'])->name('escolas.index');
        Route::get('/escolas/{id}', [EscolaController::class, 'show'])->name('escola.show');
        Route::get('/escolas/create', [EscolaController::class, 'create'])->name('escolas.create');

        // Rotas Produtos
        Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produto.show');
    });

    // == NÍVEL COZINHEIRO ==
    // TODOS os cargos (1, 2, 3, 4) podem acessar esta rota.
    Route::middleware('role:gerente,cozinheiro-chefe,nutricionista,cozinheiro')->group(function () {
        // Rotas Cardapios
        Route::get('/cardapios', [CardapioController::class, 'index'])->name('cardapios.index');
        Route::get('/cardapios/create', [CardapioController::class, 'create'])->name('cardapios.create');
        Route::get('/cardapios/{id}', [CardapioController::class, 'show'])->name('cardapio.show');
        Route::get('/cardapios/{id}/edite', [CardapioController::class, 'edit'])->name('cardapios.edit');
        Route::put('/cardapios/{id}', [CardapioController::class, 'update'])->name('cardapios.update');
        Route::delete('/cardapios/{id}', [CardapioController::class, 'destroy'])->name('cardapios.destroy');
        Route::post('/cardapios', [CardapioController::class, 'store'])->name('cardapios.store');
        // Rotas Estoque
        Route::get('/estoque', [ItemProdutoController::class, 'index'])->name('itemProdutos.index');
        Route::get('/estoque/{id}', [ItemProdutoController::class, 'show'])->name('itemProdutos.show');
    });
});
