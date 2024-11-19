<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class agendamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    
    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }

}
