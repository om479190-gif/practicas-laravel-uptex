<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Genera un título, 3 párrafos de contenido, vistas al azar y una fecha de publicación
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'views' => fake()->numberBetween(0, 500),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            // Nota: category_id y user_id se los pasaremos desde el Seeder en el siguiente paso
        ];
    }
}