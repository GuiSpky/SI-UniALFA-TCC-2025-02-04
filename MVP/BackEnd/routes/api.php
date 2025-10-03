<?php

use App\Http\Controllers\api\BairroController;
use App\Http\Controllers\api\CardapioController;
use App\Http\Controllers\api\CidadeController;
use App\Http\Controllers\api\EscolaController;
use App\Http\Controllers\api\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('cidades', CidadeController::class);
Route::apiResource('escolas', EscolaController::class);
Route::apiResource('bairros', BairroController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('cardapios', CardapioController::class);

Route::get('bairros/cidade/{cidade_id}', [BairroController::class, 'getBairros']);
Route::get('escolas/bairro', [EscolaController::class, 'getEscolaBairro']);
