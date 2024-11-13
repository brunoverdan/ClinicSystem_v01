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
        Schema::table('modelo_perguntas', function (Blueprint $table) {
          // Campos para modelo_04
          $table->string('resposta')->nullable();  // Resposta para modelo_04

          // Campos para modelo_05
          $table->string('ha_quanto_tempo')->nullable();  // Campo de texto para "Há quanto tempo" em modelo_05
          $table->string('especifique')->nullable();      // Campo de texto para "Especifique" em modelo_05

          // Campos para modelo_06
          $table->enum('resposta_modelo_06', ['sim', 'nao'])->nullable();  // Radio com opções "sim" e "não" para modelo_06
          $table->string('especifique_modelo_06')->nullable();            // Campo de texto "Especifique" para modelo_06

          // Campos para modelo_07
          $table->enum('resposta_modelo_07', ['sim', 'nao'])->nullable();  // Radio com opções "sim" e "não" para modelo_07
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelo_perguntas', function (Blueprint $table) {
            // Remove os campos adicionados
            $table->dropColumn('resposta');
            $table->dropColumn('ha_quanto_tempo');
            $table->dropColumn('especifique');
            $table->dropColumn('resposta_modelo_06');
            $table->dropColumn('especifique_modelo_06');
            $table->dropColumn('resposta_modelo_07');
        });
    }
};
