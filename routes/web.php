<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;    // Vamos criar este (Admin)
use App\Http\Controllers\BlogController;    // Vamos criar este (Público)
use App\Http\Controllers\CommentController; // Vamos criar este (Comentários)
use Illuminate\Support\Facades\Route;

// --- 1. ÁREA PÚBLICA (Visitantes) ---

// A página inicial agora lista os posts do blog
Route::get('/', [BlogController::class, 'index'])->name('blog.index');

// Ver um post completo (usando o slug, ex: /post/meu-primeiro-post)
Route::get('/post/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Enviar comentário (qualquer um pode, mas precisa aprovação)
Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('comments.store');


// --- 2. DASHBOARD (Área Logada Inicial) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// --- 3. ÁREA ADMINISTRATIVA (Protegida por Login) ---
Route::middleware('auth')->group(function () {

    // Rotas de Perfil (Padrão do Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD de Posts (Cria, Edita, Deleta)
    // O 'resource' cria automaticamente todas as rotas: index, create, store, edit, update, destroy
    Route::resource('posts', PostController::class);

    // Gerenciamento de Comentários
    Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';
