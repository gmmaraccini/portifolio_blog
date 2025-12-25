<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Página inicial do site (Lista posts publicados)
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->latest()
            ->paginate(5); // 5 posts por página

        return view('blog.index', compact('posts'));
    }

    // Mostra um post único
    public function show($slug)
    {
        // Busca pelo SLUG, não pelo ID. E garante que está publicado.
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail(); // Se não achar, dá erro 404

        // Carrega comentários aprovados
        $comments = $post->comments()->where('is_approved', true)->get();

        return view('blog.show', compact('post', 'comments'));
    }
}
