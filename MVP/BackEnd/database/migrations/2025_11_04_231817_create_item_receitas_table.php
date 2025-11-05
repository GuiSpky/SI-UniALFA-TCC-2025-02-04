<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_receitas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->bigInteger('id_cardapio')->unsigned();
            $table->foreign('id_cardapio')->references('id')->on('cardapios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_receitas');
    }
};
