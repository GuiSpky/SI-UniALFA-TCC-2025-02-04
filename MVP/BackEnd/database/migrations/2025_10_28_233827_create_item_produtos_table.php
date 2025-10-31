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
        Schema::create('item_produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade_entrada')->isNotEmpty();
            $table->integer('quantidade_saida')->default(0);
            $table->date('validade')->isNotEmpty();
            $table->bigInteger('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->bigInteger('id_escola')->unsigned();
            $table->foreign('id_escola')->references('id')->on('escolas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_produtos');
    }
};
