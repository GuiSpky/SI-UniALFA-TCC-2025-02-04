<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemConsumo extends Model
{
    protected $table = 'item_consumos'; 
    protected $fillable = ['consumo_id', 'item_produto_id', 'quantidade'];

    public function consumo()
    {
        return $this->belongsTo(Consumo::class, 'consumo_id');
    }

    public function itemProduto()
    {
        return $this->belongsTo(ItemProduto::class, 'item_produto_id');
    }
}
