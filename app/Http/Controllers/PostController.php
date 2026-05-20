<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Attachment;
use App\Http\Requests\StorePostWithAttachmentsRequest;
use App\Services\FileService;

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
        // Validamos que el usuario sea el dueño del post para poder borrar el archivo
        $this->authorize('update', $attachment->post);

        $fileService = new FileService();
        $fileService->deleteAttachment($attachment);

        return redirect()->back()->with('success', 'Archivo eliminado');
    }
}