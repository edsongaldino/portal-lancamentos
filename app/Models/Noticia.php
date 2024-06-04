<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'publicacoes';
    protected $fillable = ['data'];

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
        return url("uploads/noticia/{$this->id}/{$this->arquivo}");
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
