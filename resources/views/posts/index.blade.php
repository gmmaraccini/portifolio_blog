<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                    + Novo Post
                </a>

                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr>
                        <th class="border-b p-2">Título</th>
                        <th class="border-b p-2">Status</th>
                        <th class="border-b p-2">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td class="border-b p-2">{{ $post->title }}</td>
                            <td class="border-b p-2">
                                {{ $post->is_published ? '✅ Publicado' : '📝 Rascunho' }}
                            </td>
                            <td class="border-b p-2">
                                <a href="{{ route('posts.edit', $post) }}" class="text-blue-600">Editar</a>

                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Tem certeza?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
