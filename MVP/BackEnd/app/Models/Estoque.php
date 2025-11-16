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
        'escola_id',
        'produto_id',
        'pedido_id'
    ];

    protected $table = 'estoques';

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
