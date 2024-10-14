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
        Schema::create('ficha_perguntas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ficha_id')->unsigned();
            $table->foreign('ficha_id')->references('id')->on('fichas')->nullable();
            $table->unsignedBigInteger('pergunta_mod_01_id')->unsigned();
            $table->foreign('pergunta_mod_01_id')->references('id')->on('pergunta_mod_01s')->nullable();
            $table->unsignedBigInteger('pergunta_mod_02_id')->unsigned();
            $table->foreign('pergunta_mod_02_id')->references('id')->on('pergunta_mod_02s')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_perguntas');
    }
};
