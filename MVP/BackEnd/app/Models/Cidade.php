<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $primaryKey = 'codIbge';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = ['codIbge', 'nome', 'uf'];
}
