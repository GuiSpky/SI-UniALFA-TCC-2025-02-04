<?php

namespace Database\Factories;

use App\Models\Escola;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $escola = Escola::first() ?? Escola::factory()->create();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->faker->numerify('44########'),
            'cargo' => $this->faker->randomElement([1, 2, 3, 4]),
            'password' => Hash::make('senhateste123'),
            'escola_id' => $escola->id,
        ];
    }
}
