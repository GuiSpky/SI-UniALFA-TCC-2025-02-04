<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consumo;
use App\Models\ItemConsumo;
use App\Models\ItemProduto;

class ConsumoSeeder extends Seeder
{
    public function run(): void
    {
        $itensEstoque = ItemProduto::pluck('id')->toArray();

        if (empty($itensEstoque)) {
            $this->command->warn('⚠️ Nenhum item de estoque encontrado. Execute o seeder ItemProdutoSeeder primeiro.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $consumo = Consumo::create();

            $idsAleatorios = collect($itensEstoque)->random(min(3, count($itensEstoque)));
            foreach ($idsAleatorios as $id) {
                ItemConsumo::create([
                    'consumo_id' => $consumo->id,
                    'item_produto_id' => $id,
                    'quantidade' => rand(1, 5),
                ]);
            }
        }
    }
}
