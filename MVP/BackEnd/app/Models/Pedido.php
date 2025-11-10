<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'id_escola'];

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class, 'id_escola');
    }
}
