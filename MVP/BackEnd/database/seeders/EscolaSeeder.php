<?php

namespace Database\Seeders;

use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Escola;
use Illuminate\Database\Seeder;

class EscolaSeeder extends Seeder
{
    public function run(): void
    {
        $escolas = [
            ['cidade_id' => 1, 'bairro_id' => 1, 'estoque_central' => 1, 'nome' => 'Merenda'],
            ['cidade_id' => 1, 'bairro_id' => 2, 'estoque_central' => 0, 'nome' => 'Colégio Estadual Zona I'],
        ];

        foreach ($escolas as &$escola) {
            $escola['created_at'] = now();
            $escola['updated_at'] = now();
        }

        Escola::insert($escolas);

        if (Cidade::count() === 0) {
            $this->call(CidadeSeeder::class);
        }

        if (Bairro::count() === 0) {
            $this->call(BairroSeeder::class);
        }

        Escola::factory(10)->create();
    }
}
