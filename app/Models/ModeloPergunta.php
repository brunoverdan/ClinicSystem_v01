<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloPergunta extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'pergunta', 'pergunta');
    }
}
