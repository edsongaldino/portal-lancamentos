<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    protected $table = 'parceiros';

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }
}
