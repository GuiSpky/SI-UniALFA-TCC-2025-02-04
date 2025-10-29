<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProduto extends Model
{
    protected $fillable = [
        'quantidade',
        'validade',
        'DataEntrada',
        'id_deposito',
    ];
    protected $table = 'ItemProduto';

    public function bairro()
    {
        return $this->belongsTo(Escola::class, 'id_deposito');
    }
}
