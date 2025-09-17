<?php

namespace Database\Factories;

use App\Models\Bairro;
use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Escola>
 */
class EscolaFactory extends Factory
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
            'id_cidade' => Cidade::all()->random()->id,
            'id_bairro' => Bairro::all()->random()->id,
        ];
    }
}
