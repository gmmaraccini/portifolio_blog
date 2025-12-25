<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('posts.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Título:</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Conteúdo:</label>
                        <textarea name="body" rows="10" class="w-full border rounded p-2" required>{{ $post->body }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_published" value="1" class="form-checkbox" {{ $post->is_published ? 'checked' : '' }}>
                            <span class="ml-2">Publicar (visível no blog)</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                            Atualizar Post
                        </button>

                        <a href="{{ route('posts.index') }}" class="text-gray-500 hover:underline">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
