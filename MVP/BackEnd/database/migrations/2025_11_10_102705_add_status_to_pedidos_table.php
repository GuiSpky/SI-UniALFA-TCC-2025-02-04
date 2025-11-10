<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Adiciona o campo id_escola logo após o ID (ou onde fizer mais sentido)
            $table->unsignedBigInteger('id_escola')->after('id');
            $table->foreign('id_escola')->references('id')->on('escolas')->onDelete('cascade');

            // Adiciona o status (caso ainda não exista na tabela)
            if (!Schema::hasColumn('pedidos', 'status')) {
                $table->string('status')->default('Editando')->after('id_escola');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['id_escola']);
            $table->dropColumn(['id_escola', 'status']);
        });
    }
};
