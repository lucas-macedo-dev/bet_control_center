<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'method',
        'url',
        'request_body',
        'response_body',
        'status',
        'http_status',
    ];
}
