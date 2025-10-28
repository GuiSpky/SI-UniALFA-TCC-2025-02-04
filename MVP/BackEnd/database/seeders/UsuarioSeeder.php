<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Escola; // Importe o model Escola

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garante que a tabela de usuários esteja vazia antes de popular
        User::truncate();

        // Pega a primeira escola cadastrada para associar aos usuários.
        // Crie uma escola se nenhuma existir para evitar erros.
        $escola = Escola::first();
        if (!$escola) {
            $escola = Escola::factory()->create(['name' => 'Escola Padrão']);
        }

        $cargos = [
            1 => 'Gerente',
            2 => 'Cozinheiro Chefe',
            3 => 'Cozinheiro',
            4 => 'Nutricionista',
        ];

        foreach ($cargos as $cargoId => $cargoNome) {
            // Transforma o nome para um formato de e-mail (ex: "Cozinheiro Chefe" -> "cozinheiro-chefe")
            $emailNome = str_replace(' ', '-', strtolower($cargoNome));

            User::factory()->create([
                'name' => $cargoNome,
                'email' => $emailNome . '@gmail.com',
                'password' => Hash::make(strtolower($emailNome) . '123'),
                'cargo' => $cargoId,
                'id_escola' => $escola->id, // Associa a uma escola existente
                'telefone' => '0000000000' . $cargoId, // Telefone único para cada um
            ]);
        }
    }
}
