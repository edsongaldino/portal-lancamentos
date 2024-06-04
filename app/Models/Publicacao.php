<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'publicacoes';

     /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getUrl()
    {
        $url_amigavel = url_amigavel($this->titulo);
        return "/artigo/{$this->id}/{$url_amigavel}";
    }

    public function getUrlCompleta()
    {
        $url_amigavel = url_amigavel($this->titulo);
        return "https://www.lancamentosonline.com.br/artigo/{$this->id}/{$url_amigavel}";
    }

    public function getFoto()
    {
        return url("/uploads/publicacoes/{$this->arquivo}");
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getDataAttribute($valor)
    {
        if ($valor) {
            return (new \DateTime($valor))->format('d/m/Y');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
