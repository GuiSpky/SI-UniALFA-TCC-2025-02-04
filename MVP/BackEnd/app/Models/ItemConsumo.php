<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemConsumo extends Model
{
    protected $table = 'item_consumos';
    protected $fillable = [
        'id_consumo',
        'id_item_produto',
        'quantidade'
    ];

    public function itemProduto()
    {
        return $this->belongsTo(ItemProduto::class, 'item_produto_id');
    }

    public function consumo()
    {
        return $this->belongsTo(Consumo::class, 'consumo_id');
    }
}
