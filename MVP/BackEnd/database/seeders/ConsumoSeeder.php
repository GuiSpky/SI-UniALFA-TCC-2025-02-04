<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consumo;
use App\Models\ItemConsumo;

class ConsumoSeeder extends Seeder
{
    public function run(): void
    {
        // Gera 10 consumos com datas aleatórias dos últimos 7 dias
        Consumo::factory(30)
            ->create()
            ->each(function ($consumo) {
                // Para cada consumo, cria entre 1 e 3 itens relacionados
                ItemConsumo::factory(rand(1, 3))->create([
                    'consumo_id' => $consumo->id,
                ]);
            });
    }
}
