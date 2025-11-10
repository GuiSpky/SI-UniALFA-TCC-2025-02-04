<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{

    use HasFactory;

    protected $fillable = [
        'nome',
        'id_cidade',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    protected $table = 'bairros';

    public function escolas()
    {
        return $this->hasMany(Escola::class);
    }

    public $timestamps = true;
}
