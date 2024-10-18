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
        Schema::create('modelo_perguntas', function (Blueprint $table) {
            $table->id();
            $table->string('pergunta');
            $table->enum('modelo', ['modelo_01', 'modelo_02', 'modelo_03']);  // Escolha entre modelo 01 e modelo 02
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelo_perguntas');
    }
};
