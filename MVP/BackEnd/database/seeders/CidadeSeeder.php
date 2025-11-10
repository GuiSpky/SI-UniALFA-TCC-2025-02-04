<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    public function run(): void
    {
        $cidades = [
            ['codIbge' => '4108304', 'nome' => 'Maringá', 'uf' => 'PR'],
            ['codIbge' => '4119152', 'nome' => 'Sarandi', 'uf' => 'PR'],
            ['codIbge' => '4109401', 'nome' => 'Paranavaí', 'uf' => 'PR'],
            ['codIbge' => '4104808', 'nome' => 'Curitiba', 'uf' => 'PR'],
            ['codIbge' => '4106903', 'nome' => 'Londrina', 'uf' => 'PR'],
            ['codIbge' => '4105805', 'nome' => 'Foz do Iguaçu', 'uf' => 'PR'],
            ['codIbge' => '4113709', 'nome' => 'Ponta Grossa', 'uf' => 'PR'],
            ['codIbge' => '4111554', 'nome' => 'Paiçandu', 'uf' => 'PR'],
            ['codIbge' => '4101406', 'nome' => 'Araucária', 'uf' => 'PR'],
            ['codIbge' => '4119905', 'nome' => 'Toledo', 'uf' => 'PR'],
            ['codIbge' => '4128104', 'nome' => 'Umuarama', 'uf' => 'PR'],
        ];

        foreach ($cidades as &$cidade) {
            $cidade['created_at'] = now();
            $cidade['updated_at'] = now();
        }

        Cidade::insert($cidades);
    }
}
