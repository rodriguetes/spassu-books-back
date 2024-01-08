<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->title(),
            'editora' => $this->faker->name(),
            'edicao' => $this->faker->year(),
            'anoPublicacao' => $this->faker->numerify(),
            'valor' => $this->faker->randomFloat(),
        ];
    }
}
