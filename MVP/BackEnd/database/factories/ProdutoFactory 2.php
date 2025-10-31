<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $grupos = ['Proteínas', 'Carboidratos', 'Oleogenosos', 'Fibras'];

        return [
            'nome' => $this->faker->randomElement([
                'Arroz Branco',
                'Feijão Carioca',
                'Macarrão',
                'Peito de Frango',
                'Azeite de Oliva',
                'Farinha de Trigo',
                'Linhaça',
                'Aveia em Flocos',
                'Castanha-do-Pará',
                'Carne Moída Bovina'
            ]),
            'grupo' => fake()->randomElement([
                '1',
                '2',
                '3',
                '4',
            ]),
        ];
    }
}
