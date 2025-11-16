<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'telefone',
        'cargo',
        'password',
        'escola_id',
    ];

    protected $casts = [
        'cargo' => 'integer',
        'escola_id' => 'integer',
    ];

    // Relação com Escola (cada usuário pertence a uma escola)
    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }
}
