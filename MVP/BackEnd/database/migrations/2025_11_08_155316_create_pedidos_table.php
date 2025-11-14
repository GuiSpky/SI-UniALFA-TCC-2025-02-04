<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            // Relacionamento com escola
            $table->unsignedBigInteger('id_escola');
            $table->foreign('id_escola')->references('id')->on('escolas')->onDelete('cascade');

            // Status do pedido
            $table->string('status')->default('Editando');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
