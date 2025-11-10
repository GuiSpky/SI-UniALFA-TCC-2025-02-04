<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemProduto;
use Carbon\Carbon;

class ItemProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $itens = [];

        for ($i = 1; $i <= 10; $i++) {
            $itens[] = [
                'quantidade_entrada' => rand(50, 200),
                'quantidade_saida' => rand(0, 50),
                'validade' => Carbon::now()->addDays(rand(30, 180))->toDateString(),
                'id_produto' => $i,
                'id_escola' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ItemProduto::insert($itens);
    }
}
