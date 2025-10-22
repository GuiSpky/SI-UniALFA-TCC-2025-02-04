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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 30)->isNotEmpty();
            $table->string('email', 30)->unique()->isNotEmpty();
            $table->string('telefone', 30)->unique()->isNotEmpty();
            $table->string('cargo', 30)->isNotEmpty();
            $table->string('senha')->isNotEmpty();
            $table->bigInteger('id_escola')->unsigned()->nullable();
            $table->foreign('id_escola')->references('id')->on('escolas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
