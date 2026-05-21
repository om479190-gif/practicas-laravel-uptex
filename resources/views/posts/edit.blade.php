<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="font-bold text-gray-700">Título del Post</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="block w-full mt-1 border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="font-bold text-gray-700">Contenido</label>
                        <textarea name="content" class="block w-full mt-1 border-gray-300 rounded-md" rows="6" required>{{ $post->content }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>