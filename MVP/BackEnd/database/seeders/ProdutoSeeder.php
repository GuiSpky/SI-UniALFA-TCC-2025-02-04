<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            ['nome' => 'Arroz Branco', 'grupo' => '1', 'medida' => 'Pacote'],
            ['nome' => 'Feijão Carioca', 'grupo' => '2', 'medida' => 'Pacote'],
            ['nome' => 'Macarrão', 'grupo' => '3', 'medida' => 'Pacote'],
            ['nome' => 'Peito de Frango', 'grupo' => '4', 'medida' => 'Kg'],
            ['nome' => 'Azeite de Oliva', 'grupo' => '1', 'medida' => 'L'],
            ['nome' => 'Farinha de Trigo', 'grupo' => '2', 'medida' => 'Pacote'],
            ['nome' => 'Linhaça', 'grupo' => '3', 'medida' => 'Pacote'],
            ['nome' => 'Aveia em Flocos', 'grupo' => '4', 'medida' => 'Pacote'],
            ['nome' => 'Castanha-do-Pará', 'grupo' => '1', 'medida' => 'Pacote'],
            ['nome' => 'Carne Moída Bovina', 'grupo' => '2', 'medida' => 'Kg'],
        ];

        foreach ($produtos as &$produto) {
            $produto['created_at'] = now();
            $produto['updated_at'] = now();
        }

        Produto::insert($produtos);
    }
}
