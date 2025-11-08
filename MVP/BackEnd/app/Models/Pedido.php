<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'quantidade_pedido',
        'id_item_pedido',
    ];
    protected $table = 'pedido';

//     public function item_produtos()
//     {
//         return $this->belongsTo(ItemProduto::class, 'id_item_produto');
//     }
}
