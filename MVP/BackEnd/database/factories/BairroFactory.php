<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bairro;
use App\Models\Cidade;

class BairroFactory extends Factory
{
    protected $model = Bairro::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->streetName,
            'cidade_id' => Cidade::inRandomOrder()->first()->id ?? 1,
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
