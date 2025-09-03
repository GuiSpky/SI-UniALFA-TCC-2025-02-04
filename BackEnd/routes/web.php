<?php

use App\Http\Controllers\CidadeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
