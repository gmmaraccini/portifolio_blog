<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Portfólio Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<nav class="bg-white shadow mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="{{ route('blog.index') }}" class="text-2xl font-bold text-gray-800">Meu Blog</a>

        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 font-semibold">Painel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-semibold">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-gray-600 hover:text-gray-900 font-semibold">Registrar</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<div class="max-w-4xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Últimas Publicações</h1>

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 hover:shadow-lg transition">
                <h2 class="text-2xl font-bold text-blue-600 mb-2">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="text-gray-500 text-sm mb-4">
                    Postado em {{ $post->created_at->format('d/m/Y') }} por {{ $post->user->name }}
                </p>
                <p class="text-gray-700 mb-4">
                    {{ Str::limit($post->body, 150) }} </p>
                <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-500 font-semibold hover:underline">
                    Ler mais &rarr;
                </a>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500">Ainda não há posts publicados.</p>
            <p class="text-sm text-gray-400 mt-2">Faça login no painel administrativo para criar o primeiro post.</p>
        </div>
    @endif
</div>

<footer class="text-center py-8 text-gray-500 text-sm">
    &copy; {{ date('Y') }} Blog Portfólio - Laravel 12
</footer>

</body>
</html>
