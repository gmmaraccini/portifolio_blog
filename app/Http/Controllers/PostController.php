<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Importante para criar o slug
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Lista todos os posts na área administrativa
    public function index()
    {
        // Pega os posts mais recentes primeiro e pagina de 10 em 10
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Mostra o formulário de criar
    public function create()
    {
        return view('posts.create');
    }

    // Salva no banco
    public function store(Request $request)
    {
        // 1. Validação
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'is_published' => 'boolean'
        ]);

        // 2. Prepara os dados extras
        $validated['user_id'] = Auth::id(); // Pega o ID do admin logado
        $validated['slug'] = Str::slug($validated['title']); // Cria "meu-titulo-legal"

        // Checkbox não marcado não envia valor, então garantimos o false se vier null
        $validated['is_published'] = $request->has('is_published');

        // 3. Cria
        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    // Mostra formulário de edição
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Atualiza no banco
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // Atualiza o slug se o título mudar
        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post atualizado!');
    }

    // Deleta
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deletado.');
    }
}
