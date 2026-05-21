<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Agrega esta línea aquí arriba
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; // 2. Agrega esta línea justo al inicio de la clase

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
}
