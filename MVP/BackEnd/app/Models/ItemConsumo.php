<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemConsumo extends Model
{
    protected $table = 'item_consumos'; 
    protected $fillable = ['consumo_id', 'estoque_id', 'quantidade'];

    public function consumo()
    {
        return $this->belongsTo(Consumo::class, 'consumo_id');
    }

    public function estoque()
    {
        return $this->belongsTo(Estoque::class, 'estoque_id');
    }
}
