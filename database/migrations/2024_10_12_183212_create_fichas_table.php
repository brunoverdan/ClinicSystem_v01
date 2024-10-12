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
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->longText('queixa')->nullable();
            $table->longText('habito')->nullable();
            $table->longText('anamnesia')->nullable();
            $table->string('exame_imagem')->nullable();
            $table->string('exame_imagem_quais')->nullable();
            $table->string('usa_medicamento')->nullable();
            $table->string('usa_medicamento_quais')->nullable();
            $table->string('realizou_cirurgia')->nullable();
            $table->string('realizou_cirurgia_quais')->nullable();
            $table->string('lasague_mais')->nullable();
            $table->string('lasague_menos')->nullable();
            $table->string('lasague_direito')->nullable();
            $table->string('lasague_esquerdo')->nullable();
            $table->string('slump_mais')->nullable();
            $table->string('slump_menos')->nullable();
            $table->string('slump_direito')->nullable();
            $table->string('slump_esquerdo')->nullable();
            $table->string('patrick_mais')->nullable();
            $table->string('patrick_menos')->nullable();
            $table->string('patrick_direito')->nullable();
            $table->string('patrick_esquerdo')->nullable();
            $table->string('rotacao_mais')->nullable();
            $table->string('rotacao_menos')->nullable();
            $table->string('rotacao_direito')->nullable();
            $table->string('rotacao_esquerdo')->nullable();
            $table->string('flrxao_mais')->nullable();
            $table->string('flrxao_menos')->nullable();
            $table->string('flrxao_direito')->nullable();
            $table->string('flrxao_esquerdo')->nullable();
            $table->string('valsalva_mais')->nullable();
            $table->string('valsalva_menos')->nullable();
            $table->string('valsalva_direito')->nullable();
            $table->string('valsalva_esquerdo')->nullable();
            $table->date('data')->nullable();
            $table->unsignedBigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};
