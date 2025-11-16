<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Nome da tabela alterado para 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // 2. Campo 'nome' alterado para 'name'
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('telefone', 20)->unique();

            // Cargo numérico (mantido como está, ótimo para controle de acesso)
            $table->unsignedTinyInteger('cargo');

            // 5. Campo 'email_verified_at' adicionado (recomendado)
            $table->timestamp('email_verified_at')->nullable();

            // 3. Campo 'senha' alterado para 'password'
            $table->string('password');

            // 4. Campo 'remember_token' adicionado
            $table->rememberToken();

            // Relacionamento com escolas (mantido, mas atenção ao nome da chave estrangeira)
            // Vamos manter o seu, mas fique ciente disso ao definir os relacionamentos no Model.
            $table->foreignId('escola_id')
                ->nullable()
                ->constrained('escolas')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Nome da tabela alterado aqui também
        Schema::dropIfExists('users');
    }
};
