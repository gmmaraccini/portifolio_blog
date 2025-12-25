<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Título:</label>
                        <input type="text" name="title" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Conteúdo:</label>
                        <textarea name="body" rows="5" class="w-full border rounded p-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_published" value="1" class="form-checkbox">
                            <span class="ml-2">Publicar agora?</span>
                        </label>
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Salvar Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
