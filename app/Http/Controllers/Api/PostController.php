<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Lista os posts
    public function index()
    {
        // Pega apenas os publicados
        $posts = Post::where('is_published', true)->latest()->get();

        // Retorna formatado em JSON
        return PostResource::collection($posts);
    }

    // Mostra um post só
    public function show($id)
    {
        $post = Post::where('is_published', true)->findOrFail($id);

        return new PostResource($post);
    }
}
