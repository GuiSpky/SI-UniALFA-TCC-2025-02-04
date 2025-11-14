<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consumo;
use App\Models\Estoque;
use App\Models\ItemConsumo;

class ConsumoSeeder extends Seeder
{
    public function run(): void
    {
        $estoques = Estoque::pluck('id')->toArray();

        if (empty($estoques)) {
            $this->command->warn('⚠️ Nenhum item de estoque encontrado. Execute o seeder EstoqueSeeder primeiro.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $consumo = Consumo::create();

            $idsAleatorios = collect($estoques)->random(min(3, count($estoques)));
            foreach ($idsAleatorios as $id) {
                ItemConsumo::create([
                    'consumo_id' => $consumo->id,
                    'estoque_id' => $id,
                    'quantidade' => rand(1, 5),
                ]);
            }
        }
    }
}
