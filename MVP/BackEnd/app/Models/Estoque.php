<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = [
        'quantidade_entrada',
        'quantidade_saida',
        'quantidade_saldo',
        'validade',
        'id_escola',
        'id_produto'
    ];

    protected $table = 'estoque';

    public function escola()
    {
        return $this->belongsTo(Escola::class, 'id_escola');
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
