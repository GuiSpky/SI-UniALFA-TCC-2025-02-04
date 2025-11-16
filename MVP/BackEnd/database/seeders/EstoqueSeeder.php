<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;
use Carbon\Carbon;

class EstoqueSeeder extends Seeder
{
    public function run(): void
    {
        $itens = [];

        for ($i = 1; $i <= 10; $i++) {
            $entrada = rand(50, 200);
            $saida = 0;
            $saldo = $entrada;

            $itens[] = [
                'quantidade_entrada' => $entrada,
                'quantidade_saida'   => $saida,
                'quantidade_saldo'   => $saldo,
                'validade'           => Carbon::now()->addDays(rand(30, 180))->toDateString(),
                'produto_id'         => $i,
                'escola_id'          => 1,
                'created_at'         => now(),
                'updated_at'         => now(),
            ];
        }

        Estoque::insert($itens);
    }
}
