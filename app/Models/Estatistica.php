<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatistica extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'estatisticas';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarVisualizacao($empreendimento)
    {
        (new ResumoEstatistica())->salvarResumo($empreendimento, 'Visualização');
        $model = $this;
        $model->empreendimento_id = $empreendimento->id;
        $model->tipo = 'Visualização';
        $model->save();
    }

    public function salvarClique($empreendimento)
    {
        (new ResumoEstatistica())->salvarResumo($empreendimento, 'Clique');
        $model = $this;
        $model->empreendimento_id = $empreendimento->id;
        $model->tipo = 'Clique';
        $model->save();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
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