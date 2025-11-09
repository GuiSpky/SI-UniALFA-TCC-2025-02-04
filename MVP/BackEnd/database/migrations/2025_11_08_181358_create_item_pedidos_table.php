<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_pedidos', function (Blueprint $table) {
            $table->id();

            // Relação com pedidos
            $table->foreignId('pedido_id')
                ->constrained('pedidos')
                ->onDelete('cascade');

            // Relação com produtos
            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->onDelete('cascade');

            // Quantidade do produto no pedido
            $table->integer('quantidade')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_pedidos');
    }
};
