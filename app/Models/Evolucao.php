<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Evolucao extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $dates = ['data'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
