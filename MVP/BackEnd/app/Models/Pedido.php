<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [];

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
