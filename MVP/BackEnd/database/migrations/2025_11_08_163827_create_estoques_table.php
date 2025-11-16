<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade_entrada')->isNotEmpty();
            $table->integer('quantidade_saida')->default(0);
            $table->integer('quantidade_saldo')->default(0);
            $table->date('validade')->isNotEmpty();

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->unsignedBigInteger('escola_id');
            $table->foreign('escola_id')->references('id')->on('escolas');

            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')
                ->references('id')->on('pedidos')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
