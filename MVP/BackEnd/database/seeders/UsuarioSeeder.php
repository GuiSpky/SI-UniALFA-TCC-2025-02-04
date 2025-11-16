<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Escola;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela antes de popular
        User::truncate();

        // Garante que exista ao menos uma escola
        $escola = Escola::first() ?? Escola::factory()->create(['name' => 'Escola Padrão']);

        $cargos = [
            1 => 'Gerente',
            2 => 'Cozinheiro Chefe',
            3 => 'Cozinheiro',
            4 => 'Nutricionista',
        ];

        foreach ($cargos as $cargoId => $cargoNome) {
            $emailNome = str_replace(' ', '-', strtolower($cargoNome));

            User::factory()->create([
                'name' => $cargoNome,
                'email' => "{$emailNome}@gmail.com",
                'password' => Hash::make("{$emailNome}123"),
                'cargo' => $cargoId,
                'escola_id' => $cargoId,
                'telefone' => '4499999999' . $cargoId, // Telefone fictício único
            ]);
        }
    }
}
