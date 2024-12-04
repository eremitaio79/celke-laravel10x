<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClasseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // Nome aleatório com 3 palavras
            'description' => $this->faker->paragraph, // Parágrafo de texto
            'status' => $this->faker->randomElement([0, 1]), // Status aleatório (0 ou 1)
            'image' => $this->faker->imageUrl(640, 480, 'courses', true, 'Faker'), // URL de imagem
            'course_id' => \App\Models\Course::factory(), // Cria uma relação com o modelo Course
        ];
    }
}
