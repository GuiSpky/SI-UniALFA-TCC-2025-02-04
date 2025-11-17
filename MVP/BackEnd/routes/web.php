<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BairroController,
    CardapioController,
    CidadeController,
    ConsumoController,
    DashboardController,
    EscolaController,
    EstoqueController,
    PedidoController,
    ProdutoController,
    ProfileController,
    RelatorioController,
    UserController
};

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // PERFIL
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // ROTAS DE GERENTE (cargo 1)
    Route::middleware('role:gerente')->group(function () {

        // CRUDs simples usando resources
        Route::resources([
            'bairros'  => BairroController::class,
            'cidades'  => CidadeController::class,
            'usuarios' => UserController::class,
            'estoques'  => EstoqueController::class,
            'escolas'  => EscolaController::class,
            'produtos' => ProdutoController::class,
        ]);

        // Relatórios
        Route::prefix('relatorios')->name('relatorios.')->group(function () {
            Route::get('/', [RelatorioController::class, 'index'])->name('index');
            Route::get('/resultado', [RelatorioController::class, 'gerar'])->name('resultado');
            Route::post('/', [RelatorioController::class, 'store'])->name('store');

            Route::get('/exportar/pdf',   [RelatorioController::class, 'exportarPDF'])->name('exportar.pdf');
            Route::get('/exportar/excel', [RelatorioController::class, 'exportarExcel'])->name('exportar.excel');
        });

        // Pedido – ações exclusivas
        Route::put('pedidos/{pedido}/confirmado', [PedidoController::class, 'confirmado'])
            ->name('pedidos.confirmado');
    });

    // ROTAS (cargo 1 e 2) – GERENTE E COZINHEIRO-CHEFE
    Route::middleware('role:gerente,cozinheiro-chefe')->group(function () {

        Route::resource('consumos', ConsumoController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::resource('pedidos', PedidoController::class)
            ->only(['index', 'show']);
    });

    // ROTAS (somente COZINHEIRO-CHEFE)
    Route::middleware('role:cozinheiro-chefe')->group(function () {

        Route::resource('pedidos', PedidoController::class)
            ->only(['create', 'store']);

        Route::put('pedidos/{pedido}/enviar',   [PedidoController::class, 'enviar'])->name('pedidos.enviar');
        Route::put('pedidos/{pedido}/recebido', [PedidoController::class, 'recebido'])->name('pedidos.recebido');
    });

    // ROTAS (cargo 1,2,4) – GERENTE / CHEFE / NUTRI
    Route::middleware('role:gerente,cozinheiro-chefe,nutricionista')->group(function () {

        Route::resource('escolas', EscolaController::class)->only(['index', 'show', 'create']);
        Route::resource('produtos', ProdutoController::class)->only(['index', 'show']);
    });

    // ROTAS (cargo 1,2,3,4) – TODOS OS COZINHEIROS
    Route::middleware('role:gerente,cozinheiro-chefe,nutricionista,cozinheiro')->group(function () {

        Route::resource('cardapios', CardapioController::class);

        Route::resource('estoques', EstoqueController::class)->only(['index', 'show']);
    });

    // Fallback
    Route::fallback(function () {
        return redirect()->route('dashboard')->with('error', 'Página não encontrada.');
    });
});
