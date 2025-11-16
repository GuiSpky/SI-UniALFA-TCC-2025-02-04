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
        $estoques = Estoque::all();

        if ($estoques->isEmpty()) {
            $this->command->warn('⚠️ Nenhum estoque encontrado. Rode o EstoqueSeeder primeiro.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {

            $escolaId = $estoques->random()->escola_id;

            $consumo = Consumo::create([
                'escola_id' => $escolaId,
            ]);

            $estoquesDaEscola = $estoques->where('escola_id', $escolaId);

            $selecionados = $estoquesDaEscola->random(min(3, $estoquesDaEscola->count()));

            foreach ($selecionados as $est) {
                ItemConsumo::create([
                    'consumo_id' => $consumo->id,
                    'estoque_id' => $est->id,
                    'quantidade' => rand(1, 5),
                ]);
            }
        }
    }
}
