<?php

use App\Http\Controllers\api\CidadesControler;
use Illuminate\Support\Facades\Route;


Route::apiResource('cidades', CidadesControler::class);
