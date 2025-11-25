<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition(): array
    {
        $grupos = [1, 2, 3, 4];
        $medidas = [
            "Pacote 250g", "Pacote 500g", "Pacote 1kg", "Saco 25kg",
            "Caixa 10kg", "Garrafa 1L", "Unidade", "Dúzia"
        ];

        return [
            'nome' => $this->faker->unique()->word() . ' ' . $this->faker->randomElement(['Premium', 'Extra', 'Refinado']),
            'grupo' => $this->faker->randomElement($grupos),
            'medida' => $this->faker->randomElement($medidas),
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
