<?php

use App\Http\Controllers\CidadeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cidades', [CidadeController::class, 'index'])->name('cidades.index');
Route::get('/cidades/create', [CidadeController::class, 'create'])->name('cidades.create');
Route::get('/cidades/{id}', [CidadeController::class, 'show'])->name('cidades.show');
Route::get('/cidades/{id}/edit', [CidadeController::class, 'edit'])->name('cidades.edit');
Route::put('/cidades/{id}', [CidadeController::class, 'update'])->name('cidades.update');
Route::delete('/cidades/{id}', [CidadeController::class, 'destroy'])->name('cidades.destroy');
