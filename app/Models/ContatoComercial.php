<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContatoComercial extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contato_comercial';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvar($request)
    {
        $this->construtora = $request->construtora;
        $this->cidade = $request->cidade;
        $this->nome = $request->nome;
        $this->telefone = $request->telefone;
        $this->email = $request->email;
    
        if($this->save()){
            return true;
        }else{
            return false;
        }
        
    }
}
