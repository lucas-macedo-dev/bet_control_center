<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = ['valor_apostado', 'valor_retorno', 'descricao'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
