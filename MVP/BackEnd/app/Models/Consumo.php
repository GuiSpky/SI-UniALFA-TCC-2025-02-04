<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    protected $table = 'consumos';
    protected $fillable = ['escola_id'];

    public function itens()
    {
        return $this->hasMany(ItemConsumo::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }
}
