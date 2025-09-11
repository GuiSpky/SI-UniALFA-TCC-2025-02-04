<?php

use App\Http\Controllers\Api\CidadesController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cidades', CidadesController::class);