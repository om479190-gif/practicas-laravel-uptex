<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Genera un párrafo aleatorio para simular la opinión de un usuario
            'content' => fake()->paragraph(),
        ];
    }
}