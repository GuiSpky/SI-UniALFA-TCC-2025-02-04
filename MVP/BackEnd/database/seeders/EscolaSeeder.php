<?php

namespace Database\Seeders;

use App\Models\Escola;
use Illuminate\Database\Seeder;

class EscolaSeeder extends Seeder
{
    public function run(): void
    {
        $escolas = [
            ['cidade_id' => 11, 'bairro_id' => 1, 'estoque_central' => 1, 'nome' => 'Merenda'],
            ['cidade_id' => 11, 'bairro_id' => 2, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona I'],
            ['cidade_id' => 11, 'bairro_id' => 3, 'estoque_central' => 0, 'nome' => 'Escola Municipal Zona II'],
            ['cidade_id' => 11, 'bairro_id' => 4, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona III'],
            ['cidade_id' => 11, 'bairro_id' => 5, 'estoque_central' => 0, 'nome' => 'Escola Municipal Zona IV'],
            ['cidade_id' => 11, 'bairro_id' => 6, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona V'],
            ['cidade_id' => 11, 'bairro_id' => 7, 'estoque_central' => 0, 'nome' => 'Escola Municipal Jardim Aeroporto'],
            ['cidade_id' => 11, 'bairro_id' => 8, 'estoque_central' => 0, 'nome' => 'Colégio Parque Dom Pedro I'],
            ['cidade_id' => 11, 'bairro_id' => 9, 'estoque_central' => 0, 'nome' => 'Centro Educacional Jardim Panorama'],
            ['cidade_id' => 11, 'bairro_id' => 10, 'estoque_central' => 0, 'nome' => 'Escola Municipal Jardim Cruzeiro'],
        ];

        foreach ($escolas as &$escola) {
            $escola['created_at'] = now();
            $escola['updated_at'] = now();
        }

        Escola::insert($escolas);
    }
}
