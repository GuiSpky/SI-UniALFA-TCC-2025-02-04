<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $table = 'consumos';
    protected $fillable = ['data'];

    public function itens()
    {
        return $this->hasMany(ItemConsumo::class, 'id_consumo');
    }
}
