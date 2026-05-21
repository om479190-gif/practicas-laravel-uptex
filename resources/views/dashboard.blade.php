<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Administrador de Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-indigo-100 p-4 rounded-lg shadow border border-indigo-200">
        <h3 class="font-bold text-indigo-800 text-lg">Total de Posts</h3>
        <p class="text-3xl font-black text-indigo-600">{{ $totalPosts }}</p>
    </div>
    <div class="bg-green-100 p-4 rounded-lg shadow border border-green-200">
        <h3 class="font-bold text-green-800 text-lg">Usuarios Registrados</h3>
        <p class="text-3xl font-black text-green-600">{{ $totalUsers }}</p>
    </div>
    <div class="bg-yellow-100 p-4 rounded-lg shadow border border-yellow-200">
        <h3 class="font-bold text-yellow-800 text-lg">Mis Publicaciones</h3>
        <p class="text-3xl font-black text-yellow-600">{{ $misPosts }}</p>
    </div>
</div>
                <div class="mb-4 flex justify-end">
                    <a href="/subir-archivos" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold shadow">
                        + Crear Nuevo Post
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">ID</th>
                                <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Título</th>
                                <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Autor</th>
                                <th class="py-3 px-4 border-b text-left font-semibold text-gray-600">Categoría</th>
                                <th class="py-3 px-4 border-b text-center font-semibold text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="py-3 px-4 border-b text-gray-800">{{ $post->id }}</td>
                                    <td class="py-3 px-4 border-b text-gray-800">{{ Str::limit($post->title, 40) }}</td>
                                    <td class="py-3 px-4 border-b text-gray-800">{{ $post->user->name }}</td>
                                    <td class="py-3 px-4 border-b text-gray-800">
                                        <span class="bg-gray-200 text-gray-700 py-1 px-2 rounded-full text-xs">
                                            {{ $post->category->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b text-center">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Editar</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este post de forma permanente?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900 font-medium ml-3">
        Borrar
    </button>
</form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>