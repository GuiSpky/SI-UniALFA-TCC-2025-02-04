<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    public function run(): void
    {
        Cidade::factory(5)->create();
    }
}
