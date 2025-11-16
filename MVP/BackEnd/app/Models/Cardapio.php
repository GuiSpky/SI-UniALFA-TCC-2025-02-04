<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $fillable = [
        'receita',
        'data',
    ];

    protected $casts =[
        'data' => 'date',
    ];

    public function itens()
    {
        return $this->hasMany(ItemReceita::class);
    }
}
