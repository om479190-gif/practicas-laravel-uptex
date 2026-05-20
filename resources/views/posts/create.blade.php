<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- IMPORTANTE: enctype="multipart/form-data" permite subir archivos -->
                <form action="/posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label>Título del Post</label>
                        <input type="text" name="title" class="block w-full mt-1 border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label>Contenido</label>
                        <textarea name="content" class="block w-full mt-1 border-gray-300 rounded-md" rows="4" required></textarea>
                    </div>

                    <!-- Input para subir los archivos (múltiple) -->
                    <div class="mb-4">
                        <label class="font-bold">Archivos adjuntos (Imágenes, PDFs, Docs)</label>
                        <br>
                        <input type="file" name="attachments[]" multiple class="mt-2">
                        
                        @error('attachments.*')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Guardar Post
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>