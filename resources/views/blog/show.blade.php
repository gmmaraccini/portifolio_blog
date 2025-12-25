<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<nav class="bg-white shadow mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center">
        <a href="{{ route('blog.index') }}" class="text-blue-500 font-bold hover:underline">&larr; Voltar para o Blog</a>
    </div>
</nav>

<div class="max-w-3xl mx-auto px-4">

    <article class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
        <p class="text-gray-500 text-sm mb-6 border-b pb-4">
            Por {{ $post->user->name }} • {{ $post->created_at->format('d/m/Y \à\s H:i') }}
        </p>

        <div class="prose max-w-none text-gray-800 leading-relaxed whitespace-pre-line">
            {{ $post->body }}
        </div>
    </article>

    <section class="bg-white p-8 rounded-lg shadow-md mb-12">
        <h3 class="text-2xl font-bold mb-6">Comentários ({{ $comments->count() }})</h3>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6 mb-10">
            @forelse($comments as $comment)
                <div class="border-b pb-4">
                    <div class="flex items-center justify-between mb-2">
                        <strong class="text-gray-800">{{ $comment->author_name }}</strong>
                        <span class="text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-600">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-gray-400 italic">Seja o primeiro a comentar!</p>
            @endforelse
        </div>

        <h4 class="text-lg font-bold mb-4">Deixe seu comentário</h4>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="author_name" placeholder="Seu Nome" required
                       class="border p-2 rounded w-full">
                <input type="email" name="author_email" placeholder="Seu E-mail" required
                       class="border p-2 rounded w-full">
            </div>
            <div class="mb-4">
                    <textarea name="content" rows="3" placeholder="O que você achou?" required
                              class="border p-2 rounded w-full"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Enviar Comentário
            </button>
        </form>
    </section>
</div>

</body>
</html>
