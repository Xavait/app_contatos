<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});
// Rota para exibir o formulário de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Rota para processar o login do usuário
Route::post('/login', [LoginController::class, 'login']);
// Rota para logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// Rota para listar contatos (página inicial)
Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');

// Rota para criar um novo contato
Route::get('/contatos/create', [ContatoController::class, 'create'])->middleware('auth')->name('contatos.create');
Route::post('/contatos', [ContatoController::class, 'store'])->middleware('auth')->name('contatos.store');

// Rota para editar o contato
Route::get('/contatos/{id}/edit', [ContatoController::class, 'edit'])->middleware('auth')->name('contatos.edit');
Route::put('/contatos/{id}', [ContatoController::class, 'update'])->middleware('auth')->name('contatos.update');

// Rota para detalhes do contato
Route::get('/contatos/{id}', [ContatoController::class, 'show'])->middleware('auth')->name('contatos.show');

// Rota para excluir o contato (exclusão suave)
Route::delete('/contatos/{id}', [ContatoController::class, 'destroy'])->middleware('auth')->name('contatos.destroy');
