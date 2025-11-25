<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Escola;
use Carbon\Carbon;

class EstoqueFactory extends Factory
{
    protected $model = Estoque::class;

    public function definition(): array
    {
        $quantidadeEntrada = $this->faker->numberBetween(50, 200);
        $quantidadeSaida = $this->faker->numberBetween(0, $quantidadeEntrada);
        $quantidadeSaldo = $quantidadeEntrada - $quantidadeSaida;

        return [
            'quantidade_entrada' => $quantidadeEntrada,
            'quantidade_saida' => $quantidadeSaida,
            'quantidade_saldo' => $quantidadeSaldo,
            'validade' => Carbon::now()->addDays($this->faker->numberBetween(1, 15))->format('Y-m-d'),

            'produto_id' => Produto::inRandomOrder()->first()->id ?? 1,
            'escola_id' => Escola::inRandomOrder()->first()->id ?? 1,
            'pedido_id' => null,

            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
