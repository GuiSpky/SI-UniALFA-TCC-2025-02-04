<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReceita extends Model
{
    protected $table = 'item_receitas';
    public $timestamps = false;
    protected $fillable = [
        'produto_id',
        'cardapio_id',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
