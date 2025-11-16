<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cidade_id',
        'bairro_id',
        'estoque_central',
    ];

    protected $table = 'escolas';

    public function bairro()
    {
        return $this->belongsTo(Bairro::class); 
    }
}
