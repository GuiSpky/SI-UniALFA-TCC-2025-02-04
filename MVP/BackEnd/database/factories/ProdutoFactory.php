<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition(): array
    {
        // Grupos separados corretamente
        $alimentos = [
            'oleogenosos' => [
                "Óleo de Soja", "Azeite", "Amendoim", "Castanha de Caju", "Castanha do Pará",
                "Nozes", "Sementes de Girassol", "Sementes de Abóbora"
            ],

            'fibras' => [
                "Maçã", "Banana", "Laranja", "Mamão", "Cenoura", "Beterraba",
                "Alface", "Tomate", "Couve", "Brócolis", "Ervilha", "Milho",
                "Feijão Verde", "Abobrinha", "Chuchu"
            ],

            'carboidratos' => [
                "Arroz", "Arroz Integral", "Macarrão Espaguete", "Macarrão Parafuso",
                "Pão Francês", "Pão de Forma", "Bolacha Água e Sal", "Bolacha Maisena",
                "Fubá", "Farinha de Trigo", "Farinha de Mandioca", "Batata", "Mandioca"
            ],

            'proteinas' => [
                "Feijão Carioca", "Feijão Preto", "Carne Moída", "Frango Congelado",
                "Peito de Frango", "Ovos", "Iogurte", "Leite Integral", "Queijo Mussarela",
                "Salsicha", "Atum", "Sardinha"
            ],
        ];

        // Escolhe um dos grupos
        $grupoEscolhido = $this->faker->randomElement(array_keys($alimentos));

        // Mapeamento para números usados no banco
        $grupoMap = [
            'oleogenosos' => 1,
            'fibras' => 2,
            'carboidratos' => 3,
            'proteinas' => 4
        ];

        // Medidas possíveis dependendo do produto
        $medidas = [
            "Pacote 250g", "Pacote 500g", "Pacote 1kg", "Saco 25kg",
            "Caixa 10kg", "Garrafa 1L", "Unidade", "Dúzia"
        ];

        return [
            'nome'       => $this->faker->unique()->randomElement($alimentos[$grupoEscolhido]),
            'grupo'      => $grupoMap[$grupoEscolhido],
            'medida'     => $this->faker->randomElement($medidas),
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'updated_at' => now(),
        ];
    }
}
