<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ItemPedido;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = Produto::pluck('id')->toArray();

        if (empty($produtos)) {
            $this->command->warn('⚠️ Nenhum produto encontrado. Execute o seeder de produtos primeiro.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $pedido = Pedido::create();

            $idsAleatorios = collect($produtos)->random(min(3, count($produtos)));
            foreach ($idsAleatorios as $id) {
                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $id,
                    'quantidade' => rand(1, 5),
                ]);
            }
        }
    }
}
