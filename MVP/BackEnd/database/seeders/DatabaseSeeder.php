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
        $this->call([
        CidadeSeeder::class,
        BairroSeeder::class,
        EscolaSeeder::class,
        ProdutoSeeder::class,
        CardapioSeeder::class,
        UsuarioSeeder::class,
        ItemProdutoSeeder::class,
        CardapioSeeder::class,
        PedidoSeeder::class,
        ConsumoSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        
    }
}
