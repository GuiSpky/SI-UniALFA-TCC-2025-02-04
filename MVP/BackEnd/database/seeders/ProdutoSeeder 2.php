<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = [
            ['nome' => 'Arroz Branco', 'grupo' => 'Carboidratos'],
            ['nome' => 'Feijão Carioca', 'grupo' => 'Proteínas'],
            ['nome' => 'Macarrão', 'grupo' => 'Carboidratos'],
            ['nome' => 'Peito de Frango', 'grupo' => 'Proteínas'],
            ['nome' => 'Azeite de Oliva', 'grupo' => 'Oleogenosos'],
            ['nome' => 'Farinha de Trigo', 'grupo' => 'Carboidratos'],
            ['nome' => 'Linhaça', 'grupo' => 'Oleogenosos'],
            ['nome' => 'Aveia em Flocos', 'grupo' => 'Fibras'],
            ['nome' => 'Castanha-do-Pará', 'grupo' => 'Oleogenosos'],
            ['nome' => 'Carne Moída Bovina', 'grupo' => 'Proteínas'],
        ];


        Produto::insert($produtos);
    }
}
