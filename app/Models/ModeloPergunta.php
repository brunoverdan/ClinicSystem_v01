<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModeloPergunta extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'pergunta', 'pergunta');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
