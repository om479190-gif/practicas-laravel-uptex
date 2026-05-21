<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Creamos 5 usuarios extra, 5 categorías y 15 etiquetas en la base de datos
        $users = User::factory(5)->create();
        $categories = Category::factory(5)->create();
        $tags = Tag::factory(15)->create();

        // 2. Creamos 50 posts pero aún NO los guardamos en la base de datos (usamos make)
        Post::factory(50)->make()->each(function ($post) use ($users, $categories, $tags) {
            
            // Les asignamos un usuario y una categoría al azar de los que creamos arriba
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            
            // Ahora sí guardamos el post
            $post->save();

            // 3. Le adjuntamos entre 1 y 3 etiquetas al azar a este post
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );

            // 4. Le creamos entre 1 y 4 comentarios falsos a este post
            Comment::factory(rand(1, 4))->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}