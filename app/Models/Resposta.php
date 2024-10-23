<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resposta extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function pergunta()
    {
        return $this->belongsTo(ModeloPergunta::class, 'pergunta_id');
    }
}
