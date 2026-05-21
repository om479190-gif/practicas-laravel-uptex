<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Attachment;
use App\Http\Requests\StorePostWithAttachmentsRequest;
use App\Services\FileService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
class PostController extends Controller
{
    // Usamos el nuevo Request que permite archivos
    public function store(StorePostWithAttachmentsRequest $request)
    {
        // 1. Crear el post
        $post = auth()->user()->posts()->create([
            'title'        => $request->title,
            'content'      => $request->content,
            'category_id'  => $request->category_id,
            'published_at' => $request->published_at,
        ]);

        // 2. Adjuntar etiquetas (si hay)
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        // 3. Procesar y guardar los archivos usando el FileService
        if ($request->hasFile('attachments')) {
            $fileService = new FileService();
            
            // Recorremos cada archivo subido y lo guardamos
            foreach ($request->file('attachments') as $file) {
                $fileService->storeAttachment($file, $post->id);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Post y archivos guardados exitosamente');
    }

    // Función para eliminar un archivo específico
    public function destroyAttachment(Attachment $attachment)
    {
        // Usamos Gate en lugar de $this
        Gate::authorize('update', $attachment->post);

        $fileService = new FileService();
        $fileService->deleteAttachment($attachment);

        return redirect()->back()->with('success', 'Archivo eliminado');
    }
    public function destroy(Post $post)
    {
        // 1. Verificamos permiso usando Gate
        Gate::authorize('delete', $post);

        // 2. Borramos el post 
        $post->delete();
        
        Log::info("AUDITORIA: El usuario " . auth()->user()->name . " eliminó el post ID: " . $post->id);
        // 3. Regresamos al dashboard
        return redirect()->back()->with('success', 'Post eliminado correctamente.');
    }
    // Función para mostrar la pantalla de edición
    public function edit(Post $post)
    {
        // Verificamos permiso
        Gate::authorize('update', $post);
        
        return view('posts.edit', compact('post'));
    }

    // Función para guardar los cambios en la base de datos
    public function update(\Illuminate\Http\Request $request, Post $post)
    {
        // Verificamos permiso
        Gate::authorize('update', $post);

        // Actualizamos los datos
        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
        ]);
        Log::info("AUDITORIA: El usuario " . auth()->user()->name . " actualizó el post ID: " . $post->id);
        return redirect()->route('dashboard')->with('success', 'Post actualizado correctamente.');
    }
}