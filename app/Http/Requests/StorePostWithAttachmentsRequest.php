<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostWithAttachmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitimos que pase la autorización
    }

    public function rules(): array
    {
        return [
            'title'           => 'required|string|min:5|max:200',
            'content'         => 'required|string|min:50',
            'category_id'     => 'required|exists:categories,id',
            
            // Validaciones para los archivos
            'attachments'     => 'array|max:5', // Máximo 5 archivos a la vez
            'attachments.*'   => 'file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx' // Máximo 5MB (5120 KB)
        ];
    }

    public function messages(): array
    {
        return [
            'attachments.max'       => 'No puedes subir más de 5 archivos.',
            'attachments.*.max'     => 'Cada archivo no debe superar los 5MB.',
            'attachments.*.mimes'   => 'Solo se aceptan formatos: JPG, PNG, PDF, DOC, DOCX.'
        ];
    }
}