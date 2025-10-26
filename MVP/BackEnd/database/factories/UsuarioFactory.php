<?php

namespace Database\Factories;

use App\Models\Escola;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->email(),
            'telefone' => fake()->phoneNumber(),
            'cargo' => fake()->randomElement([
                '1',
                '2',
                '3',
                '4'
            ]),
            'senha' => fake()->password(),
            'id_escola' => Escola::all()->random()->id,
        ];
    }
}
