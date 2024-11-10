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
        Schema::table('clinicas', function (Blueprint $table) {
            $table->string('nome_fantasia')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('responsavel_nome')->nullable();
            $table->string('forma_pagamento')->nullable();

            // Dados Bancários
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta_corrente')->nullable();
            $table->string('nome_conta')->nullable();
            $table->string('cpf_cnpj_conta')->nullable();

            // Contato do responsável financeiro
            $table->string('responsavel_financeiro_nome')->nullable();
            $table->string('responsavel_financeiro_email')->nullable();
            $table->string('responsavel_financeiro_telefone')->nullable();
            $table->string('responsavel_financeiro_whatsapp')->nullable();

            // Confirmação de pagamento
            $table->date('data_pagamento_confirmacao')->nullable();
            $table->decimal('valor_pagamento', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->dropColumn([
                'nome_fantasia',
                'razao_social',
                'cpf_cnpj',
                'responsavel_nome',
                'forma_pagamento',
                'banco',
                'agencia',
                'conta_corrente',
                'nome_conta',
                'cpf_cnpj_conta',
                'responsavel_financeiro_nome',
                'responsavel_financeiro_email',
                'responsavel_financeiro_telefone',
                'responsavel_financeiro_whatsapp',
                'data_pagamento_confirmacao',
                'valor_pagamento',
            ]);
        });
    }
};
