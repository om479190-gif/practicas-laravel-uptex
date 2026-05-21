<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Genera una palabra única para la etiqueta
            'name' => fake()->unique()->word(),
        ];
    }
}