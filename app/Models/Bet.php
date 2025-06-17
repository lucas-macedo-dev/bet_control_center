<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = ['bet_value', 'value_received', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
