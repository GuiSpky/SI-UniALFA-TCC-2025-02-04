<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Escola;
use App\Models\Cidade;
use App\Models\Bairro;

class EscolaFactory extends Factory
{
    protected $model = Escola::class;

    public function definition(): array
    {
        return [
            'nome' => 'Escola ' . $this->faker->company,
            'cidade_id' => Cidade::inRandomOrder()->first()->id ?? 1,
            'bairro_id' => Bairro::inRandomOrder()->first()->id ?? 1,
            'estoque_central' => (0),
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
