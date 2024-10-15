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
        Schema::create('repostas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_modelo');
            $table->string('pergunta');
            $table->string('resposta')->nullable();
            $table->string('quais')->nullable();
            $table->integer('mais')->nullable();
            $table->integer('menos')->nullable();
            $table->integer('direito')->nullable();
            $table->integer('esquerdo')->nullable();
            $table->unsignedBigInteger('ficha_id')->unsigned();
            $table->foreign('ficha_id')->references('id')->on('fichas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repostas');
    }
};
