<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Escola;

class EstoqueSeeder extends Seeder
{
    public function run(): void
    {
        if (Produto::count() === 0) {
            $this->call(ProdutoSeeder::class);
        }

        if (Escola::count() === 0) {
            $this->call(EscolaSeeder::class);
        }

        Estoque::factory(30)->create();
    }
}
