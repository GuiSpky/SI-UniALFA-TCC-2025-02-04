<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProduto extends Model
{
    protected $fillable = [
        'quantidade_entrada',
        'quantidade_saida',
        'validade',
        'id_escola',
        'id_produto'
    ];
    protected $table = 'item_produtos';

    public function bairro()
    {
        return $this->belongsTo(Escola::class, 'id_escola');
    }
    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
