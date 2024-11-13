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
            $table->enum('modelo', ['modelo_01', 'modelo_02', 'modelo_03', 'modelo_04', 'modelo_05', 'modelo_06', 'modelo_07', 'modelo_08', 'modelo_09', 'modelo_10', 'modelo_11', 'modelo_12', 'modelo_13', 'modelo_14', 'modelo_15', 'modelo_16', 'modelo_17', 'modelo_18', 'modelo_19', 'modelo_20', 'modelo_21', 'modelo_22']);
            $table->string('aba')->nullable();  // Escolha entre modelo 01 e modelo 02
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->softDeletes();
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
