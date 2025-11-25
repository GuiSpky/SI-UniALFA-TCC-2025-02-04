<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bairro;
use App\Models\Cidade;

class BairroSeeder extends Seeder
{
    public function run(): void
    {
        if (Cidade::count() === 0) {
            $this->call(CidadeSeeder::class);
        }

        Bairro::factory(10)->create();
    }
}
