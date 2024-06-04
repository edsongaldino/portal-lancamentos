<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoTabela extends Model
{
    protected $table = 'tipo_tabela';


    public function tabela()
    {
        return $this->hasMany('App\Models\TabelaVendas');
    }

}
