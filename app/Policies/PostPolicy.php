<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    // ... (puedes dejar las otras funciones vacías o como están)

    public function update(User $user, Post $post): bool
    {
        // Retorna true si el ID del usuario coincide con el creador del post, O si es admin
        return $user->id === $post->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Post $post): bool
    {
        // Retorna true si el ID del usuario coincide con el creador del post, O si es admin
        return $user->id === $post->user_id || $user->hasRole('admin');
    }
}