<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class FileService
{
    // Función para guardar el archivo
    public function storeAttachment(UploadedFile $file, $postId)
    {
        // Generamos un nombre único para evitar que archivos con el mismo nombre se sobreescriban
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        
        // Guardamos el archivo físicamente en la carpeta storage/app/public/posts
        $path = $file->storeAs('posts/' . $postId, $filename, 'public');

        // Guardamos los datos en la base de datos
        return Attachment::create([
            'post_id'       => $postId,
            'filename'      => $filename,
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getMimeType(),
            'size'          => $file->getSize(),
            'path'          => $path,
        ]);
    }

    // Función para borrar el archivo
    public function deleteAttachment(Attachment $attachment)
    {
        // Borramos el archivo físico del disco
        Storage::disk('public')->delete($attachment->path);
        
        // Borramos el registro de la base de datos
        $attachment->delete();
    }

    // Función para obtener la URL pública del archivo
    public function getFileUrl(Attachment $attachment)
    {
        return asset('storage/' . $attachment->path);
    }
}