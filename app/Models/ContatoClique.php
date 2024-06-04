<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContatoClique extends Model
{
    protected $table = 'contato_clique';
    protected $fillable = ['empreendimento_id', 'tipo_clique', 'nome', 'email'];
}