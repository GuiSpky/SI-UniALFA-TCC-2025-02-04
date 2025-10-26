<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cargo',
        'senha',
        'id_escola',
    ];

    protected $casts = [
        'cargo' => 'integer',
        'id_escola' => 'integer',
    ];

    // Relação com Escola (cada usuário pertence a uma escola)
    public function escola()
    {
        return $this->belongsTo(Escola::class, 'id_escola');
    }
}
