<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemConsumo extends Model
{
    protected $table = 'item_consumos';

    protected $fillable = [
        'consumo_id',
        'estoque_id',
        'quantidade'
    ];

    public function consumo()
    {
        return $this->belongsTo(Consumo::class);
    }

    public function estoque()
    {
        return $this->belongsTo(Estoque::class);
    }

    /**
     * Produto consumido (via Estoque → Produto)
     */
    public function produto()
    {
        return $this->hasOneThrough(
            Produto::class,     // Model final
            Estoque::class,     // Model intermediário
            'id',               // Estoque.id
            'id',               // Produto.id
            'estoque_id',       // FK em item_consumos
            'produto_id'        // FK em estoques
        );
    }
}
