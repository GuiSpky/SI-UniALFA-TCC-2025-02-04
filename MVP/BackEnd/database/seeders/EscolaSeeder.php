<?php

namespace Database\Seeders;

use App\Models\Escola;
use Illuminate\Database\Seeder;

class EscolaSeeder extends Seeder
{
    public function run(): void
    {
        $escolas = [
            ['id_cidade' => 11, 'id_bairro' => 1, 'estoque_central' => 1, 'nome' => 'Merenda'],
            ['id_cidade' => 11, 'id_bairro' => 2, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona I'],
            ['id_cidade' => 11, 'id_bairro' => 3, 'estoque_central' => 0, 'nome' => 'Escola Municipal Zona II'],
            ['id_cidade' => 11, 'id_bairro' => 4, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona III'],
            ['id_cidade' => 11, 'id_bairro' => 5, 'estoque_central' => 0, 'nome' => 'Escola Municipal Zona IV'],
            ['id_cidade' => 11, 'id_bairro' => 6, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona V'],
            ['id_cidade' => 11, 'id_bairro' => 7, 'estoque_central' => 0, 'nome' => 'Escola Municipal Jardim Aeroporto'],
            ['id_cidade' => 11, 'id_bairro' => 8, 'estoque_central' => 0, 'nome' => 'Colégio Parque Dom Pedro I'],
            ['id_cidade' => 11, 'id_bairro' => 9, 'estoque_central' => 0, 'nome' => 'Centro Educacional Jardim Panorama'],
            ['id_cidade' => 11, 'id_bairro' => 10, 'estoque_central' => 0, 'nome' => 'Escola Municipal Jardim Cruzeiro'],
        ];

        foreach ($escolas as &$escola) {
            $escola['created_at'] = now();
            $escola['updated_at'] = now();
        }

        Escola::insert($escolas);
    }
}
