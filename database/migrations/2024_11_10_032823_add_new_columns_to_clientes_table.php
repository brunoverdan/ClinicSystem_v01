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
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('EstadoCivil')->nullable();
            $table->string('CPF')->nullable();
            $table->integer('Filhos')->nullable();
            $table->string('Profissao')->nullable();
            $table->string('Responsavel')->nullable();
            $table->string('ContatoResponsavel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['EstadoCivil', 'CPF', 'Filhos', 'Profissao', 'Responsavel', 'ContatoResponsavel']);
        });
    }
};
