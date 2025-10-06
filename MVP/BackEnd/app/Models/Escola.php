<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'id_cidade',
        'id_bairro',
    ];

    protected $table = 'escolas';

    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'id_bairro'); 
    }
}
