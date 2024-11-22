<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lancamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function servico()
    {
        return $this->belongsTo(servico::class);
    }

    // Relacionamento com Usuário (quem registrou o lançamento)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento com Cliente (quem recebeu o serviço)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Método para calcular o valor final do serviço após o desconto
    public function getValorFinalAttribute()
    {
        return $this->servico->valores - $this->desconto;
    }
}
