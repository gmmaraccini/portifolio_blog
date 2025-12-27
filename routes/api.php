<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Importante: Importar o Controller da API que criamos
use App\Http\Controllers\Api\PostController;

// Rota padrão do Laravel (Retorna o usuário logado se tiver Token)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- ROTAS DO BLOG (PÚBLICAS) ---

// Lista todos os posts (JSON)
Route::get('/posts', [PostController::class, 'index']);

// Mostra um post específico pelo ID
Route::get('/posts/{id}', [PostController::class, 'show']);

// --- ROTA DE TESTE (SEGURANÇA) ---
// Tente acessar essa rota sem token e veja o erro, depois com token funciona.
Route::get('/teste-secreto', function() {
    return response()->json(['mensagem' => 'Parabéns! Você autenticou com sucesso via Token.']);
})->middleware('auth:sanctum');
