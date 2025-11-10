<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ItemPedido;
use App\Models\Escola;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = Produto::pluck('id')->toArray();
        $escolas  = Escola::pluck('id')->toArray();

        if (empty($produtos) || empty($escolas)) {
            $this->command->warn('⚠️ É necessário ter produtos e escolas cadastrados antes de rodar este seeder.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $pedido = Pedido::create([
                'id_escola' => collect($escolas)->random(),
                'status' => 'Editando',
            ]);

            // Seleciona até 3 produtos aleatórios
            $idsAleatorios = collect($produtos)->random(min(3, count($produtos)));

            foreach ($idsAleatorios as $produtoId) {
                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produtoId,
                    'quantidade' => rand(1, 5),
                ]);
            }
        }

        $this->command->info('✅ 10 pedidos criados com itens aleatórios!');
    }
}
