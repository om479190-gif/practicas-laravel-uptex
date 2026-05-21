<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Agrega esta línea aquí arriba
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 1. Agrega esta línea para permitir que se guarden estos campos:
    protected $fillable = ['title', 'content', 'category_id', 'published_at'];

    // ... aquí abajo dejas todas tus funciones que ya tenías (user, category, attachments, etc.)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // ... aquí abajo dejas la función posts() que ya tenías guardada
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
   public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    // Conexión con el Usuario (Autor)
}