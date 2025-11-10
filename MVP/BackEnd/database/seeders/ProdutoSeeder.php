<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            ['nome' => 'Arroz Branco', 'grupo' => '1'],
            ['nome' => 'Feijão Carioca', 'grupo' => '2'],
            ['nome' => 'Macarrão', 'grupo' => '3'],
            ['nome' => 'Peito de Frango', 'grupo' => '4'],
            ['nome' => 'Azeite de Oliva', 'grupo' => '1'],
            ['nome' => 'Farinha de Trigo', 'grupo' => '2'],
            ['nome' => 'Linhaça', 'grupo' => '3'],
            ['nome' => 'Aveia em Flocos', 'grupo' => '4'],
            ['nome' => 'Castanha-do-Pará', 'grupo' => '1'],
            ['nome' => 'Carne Moída Bovina', 'grupo' => '2'],
        ];

        foreach ($produtos as &$produto) {
            $produto['created_at'] = now();
            $produto['updated_at'] = now();
        }

        Produto::insert($produtos);
    }
}
