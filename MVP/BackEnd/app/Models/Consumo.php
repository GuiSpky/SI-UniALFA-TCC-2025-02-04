<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $table = 'consumos';
    protected $fillable = [];

    public function itens()
    {
        return $this->hasMany(ItemConsumo::class, 'consumo_id');
    }
}
