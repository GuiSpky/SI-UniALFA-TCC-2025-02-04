<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemConsumo;
use App\Models\Consumo;
use App\Models\Estoque;

class ItemConsumoFactory extends Factory
{
    protected $model = ItemConsumo::class;

    public function definition(): array
    {
        return [
            'consumo_id' => Consumo::inRandomOrder()->first()->id ?? 1,
            'estoque_id' => Estoque::inRandomOrder()->first()->id ?? 1,
            'quantidade' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
