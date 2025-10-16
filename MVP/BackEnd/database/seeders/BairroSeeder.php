<?php

namespace Database\Seeders;

use App\Models\Bairro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BairroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bairros = [
            ['id_cidade' => 11, 'nome' => 'Centro'],
            ['id_cidade' => 11, 'nome' => 'Zona I'],
            ['id_cidade' => 11, 'nome' => 'Zona II'],
            ['id_cidade' => 11, 'nome' => 'Zona III'],
            ['id_cidade' => 11, 'nome' => 'Zona IV'],
            ['id_cidade' => 11, 'nome' => 'Zona V'],
            ['id_cidade' => 11, 'nome' => 'Jardim Aeroporto'],
            ['id_cidade' => 11, 'nome' => 'Parque Dom Pedro I'],
            ['id_cidade' => 11, 'nome' => 'Jardim Panorama'],
            ['id_cidade' => 11, 'nome' => 'Jardim Cruzeiro'],
        ];


        Bairro::insert($bairros);
    }
}
