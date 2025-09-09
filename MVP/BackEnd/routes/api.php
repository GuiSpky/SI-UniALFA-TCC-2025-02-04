<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CidadeController;

Route::apiResource('cidades', CidadeController::class);
