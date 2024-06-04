<?php

namespace App\Models;

use App\Models\Empreendimento;
use App\Models\EmpreendimentoPerfil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'seo';
    protected $fillable = ['nome', 'descricao', 'palavra_chave', 'h1', 'h2'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarSeo($request, $id)
    {                
        $empreendimento = (new Empreendimento())->find($id);

        $seo = $this;
        $seo->titulo = $request->titulo;
        $seo->descricao = $request->descricao;
        $seo->h1 = $request->h1;
        $seo->h2 = $request->h2;
        $seo->palavra_chave = $request->palavra_chave;
        $seo->save();

        $empreendimento->seo_id = $seo->id;
        $empreendimento->save();

        (new EmpreendimentoPerfil())->marcarPerfil($id, 'Seo');

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function empreendimento()
    {
        return $this->hasOne('App\Models\Empreendimento');
    }

    public function construtora()
    {
        return $this->hasOne('App\Models\Construtora');
    }

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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
