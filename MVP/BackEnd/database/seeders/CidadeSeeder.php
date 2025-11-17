<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    public function run(): void
    {
        $cidades = [
            ['nome' => 'Maringá', 'uf' => 'PR'],
            ['nome' => 'Sarandi', 'uf' => 'PR'],
            ['nome' => 'Paranavaí', 'uf' => 'PR'],
            ['nome' => 'Curitiba', 'uf' => 'PR'],
            ['nome' => 'Londrina', 'uf' => 'PR'],
            ['nome' => 'Foz do Iguaçu', 'uf' => 'PR'],
            ['nome' => 'Ponta Grossa', 'uf' => 'PR'],
            ['nome' => 'Paiçandu', 'uf' => 'PR'],
            ['nome' => 'Araucária', 'uf' => 'PR'],
            ['nome' => 'Toledo', 'uf' => 'PR'],
            ['nome' => 'Umuarama', 'uf' => 'PR'],
        ];

        foreach ($cidades as &$cidade) {
            $cidade['created_at'] = now();
            $cidade['updated_at'] = now();
        }

        Cidade::insert($cidades);
    }
}
