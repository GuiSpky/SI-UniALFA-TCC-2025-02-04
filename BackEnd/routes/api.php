<?php

use App\Http\Controllers\CidadeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cidades', CidadeController::class)->names([
    'index' => 'api.cidades.index',
    'store' => 'api.cidades.store',
    'show' => 'api.cidades.show',
    'update' => 'api.cidades.update',
    'destroy' => 'api.cidades.destroy',
]);
