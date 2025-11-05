<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReceita extends Model
{
    protected $table = 'item_receitas';
    public $timestamps = false;
    protected $fillable = [
        'id_produto',
        'id_cardapio',
    ];
}
