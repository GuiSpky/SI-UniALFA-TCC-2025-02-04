<?php

namespace Database\Seeders;

use App\Models\Bairro;
use Illuminate\Database\Seeder;

class BairroSeeder extends Seeder
{
    public function run(): void
    {
        $bairros = [
            ['cidade_id' => 11, 'nome' => 'Centro'],
            ['cidade_id' => 11, 'nome' => 'Zona I'],
            ['cidade_id' => 11, 'nome' => 'Zona II'],
            ['cidade_id' => 11, 'nome' => 'Zona III'],
            ['cidade_id' => 11, 'nome' => 'Zona IV'],
            ['cidade_id' => 11, 'nome' => 'Zona V'],
            ['cidade_id' => 11, 'nome' => 'Jardim Aeroporto'],
            ['cidade_id' => 11, 'nome' => 'Parque Dom Pedro I'],
            ['cidade_id' => 11, 'nome' => 'Jardim Panorama'],
            ['cidade_id' => 11, 'nome' => 'Jardim Cruzeiro'],
        ];

        foreach ($bairros as &$bairro) {
            $bairro['created_at'] = now();
            $bairro['updated_at'] = now();
        }

        Bairro::insert($bairros);
    }
}
