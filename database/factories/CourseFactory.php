<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
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
            'description' => $this->faker->paragraph, // Descrição com um parágrafo
            'price' => $this->faker->randomFloat(2, 10, 500), // Preço entre 10 e 500 com 2 casas decimais
            'image' => $this->faker->imageUrl(640, 480, 'courses', true, 'Course'), // URL fictícia para a imagem
            'status' => $this->faker->randomElement([0, 1]), // Status aleatório: 0 (inativo) ou 1 (ativo)
        ];
    }
}
