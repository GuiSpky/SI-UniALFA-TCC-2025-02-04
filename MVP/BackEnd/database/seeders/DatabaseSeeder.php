<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();
        $this->call(CidadeSeeder::class);
        $this->call(BairroSeeder::class);
        $this->call(EscolaSeeder::class);
        $this->call(CardapioSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ProdutoSeeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        
    }
}
