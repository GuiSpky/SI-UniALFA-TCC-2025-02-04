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
        Schema::create('escolas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->bigInteger('id_cidade')->unsigned();
            $table->foreign('id_cidade')->references('id')->on('cidades');
            $table->bigInteger('id_bairro')->unsigned();
            $table->foreign('id_bairro')->references('id')->on('bairros');
            $table->boolean('estoque_central')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escolas');
    }
};
