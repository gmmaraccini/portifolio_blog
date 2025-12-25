<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Salva o comentário (Público)
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'author_name' => 'required|max:100',
            'author_email' => 'required|email',
            'content' => 'required|min:5|max:500',
        ]);

        $post->comments()->create([
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            // Segurança: Remove tags HTML para evitar scripts maliciosos
            'content' => strip_tags($validated['content']),
            'is_approved' => false, // Padrão: pendente
        ]);

        return back()->with('success', 'Comentário enviado! Aguarde aprovação.');
    }

    // Aprova o comentário (Admin)
    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return back()->with('success', 'Comentário aprovado!');
    }

    // Deleta o comentário (Admin)
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comentário removido.');
    }
}
