<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cidade;

class CidadeFactory extends Factory
{
    protected $model = Cidade::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
