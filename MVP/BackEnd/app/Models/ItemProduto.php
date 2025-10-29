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
    protected $table = 'item_produtos';

    public function bairro()
    {
        return $this->belongsTo(Escola::class, 'id_deposito');
    }
    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
