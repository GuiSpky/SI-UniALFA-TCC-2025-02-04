<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cardapio;
use App\Models\Produto;
use App\Models\ItemReceita;

class CardapioSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = Produto::pluck('id')->toArray();

        if (empty($produtos)) {
            $this->command->warn('⚠️ Nenhum produto encontrado. Execute o seeder de produtos primeiro.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $cardapio = Cardapio::create([
                'receita' => 'Receita ' . ($i + 1),
                'data' => now()->subDays(rand(1, 30)),
            ]);

            // Adiciona itens aleatórios ao cardápio
            $idsAleatorios = collect($produtos)->random(min(3, count($produtos)));
            foreach ($idsAleatorios as $id) {
                ItemReceita::create([
                    'produto_id' => $id,
                    'cardapio_id' => $cardapio->id,
                ]);
            }
        }
    }
}
