<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consumo;
use App\Models\Escola;

class ConsumoFactory extends Factory
{
    protected $model = Consumo::class;

    public function definition(): array
    {
        return [
            'escola_id' => Escola::inRandomOrder()->first()->id ?? 1,
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
