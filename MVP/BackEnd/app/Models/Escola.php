<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    protected $fillable = [
        'nome',
        'id_cidade',
        'id_bairro',
    ];
}
