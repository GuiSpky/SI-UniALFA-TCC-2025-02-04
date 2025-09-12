<?php

use App\Http\Controllers\api\BairroController;
use App\Http\Controllers\api\CidadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('cidades', CidadeController::class);
Route::apiResource('bairros', BairroController::class);

