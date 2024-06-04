<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelaVendas extends Model
{

    protected $table = 'tabela_vendas';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['nome'];

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function torre()
    {
        return $this->belongsTo('App\Models\Torre');
    }

    public function quadra()
    {
        return $this->belongsTo('App\Models\Quadra');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\tipoTabela', 'tipo_tabela_id');
    }

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    public function baloes()
   	{
   		return $this->hasMany('App\Models\TabelaVendasBaloes', 'tabela_id');
   	}
    
}
