<?php

use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('viacep/index');
});

// Rota para buscar o CEP
Route::get('/buscar-cep/{cep}', [CepController::class, 'buscarCep']);
