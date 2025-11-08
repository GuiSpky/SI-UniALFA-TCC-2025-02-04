<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $fillable = [
        'quantidade_consumo',
        'id_item_produto',
        'id_pedido'
    ];
    protected $table = 'consumo';

    public function item_produtos()
    {
        return $this->belongsTo(ItemProduto::class, 'id_item_produto');
    }
}
