<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ResumoEstatistica extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'resumo_estatisticas';

    protected $fillable = [
        'total'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarResumo($empreendimento, $tipo)
    {
        $total = 1;
        $ano = date('Y');
        $mes = date('m');
        $total_resumo = $empreendimento->resumo_estatistica()->where('tipo', $tipo)->where('ano', $ano)->where('mes', $mes)->get()->first();
        
        if($total_resumo):
            $total = $total_resumo->total + 1;
        else:
            $total_resumo = $this;
        endif;

        $model = $total_resumo;
        $model->empreendimento_id = $empreendimento->id;
        $model->tipo = $tipo;
        $model->total = $total;
        $model->mes = $mes;
        $model->ano = $ano;
        $model->save();
    }

    //SALVA O RESUMO MENSAL À PARTIR DA TABELA ESTATISTICAS
    public function salvarResumoMes($empreendimento, $tipo, $mes, $ano)
    {
        $total = 1;
        $data_inicial = $ano."-".$mes."-01 00:00:01";
        $data_final = $ano."-".$mes."-31 23:59:00";

        $total_resumo = $empreendimento->resumo_estatistica()->where('tipo', $tipo)->where('ano', $ano)->where('mes', $mes)->get()->first();

        if($total_resumo):
            if($mes == '09'):

                $data_inicial = $ano."-".$mes."-01 00:00:01";
                $data_final = $ano."-".$mes."-15 23:59:00";

                $total = $empreendimento->estatistica()->where('tipo', $tipo)->whereBetween('created_at', [$data_inicial, $data_final])->count();      
                $model = $this;
                $model->empreendimento_id = $empreendimento->id;
                $model->tipo = $tipo;
                $model->total = $total+$total_resumo["total"];
                $model->mes = $mes;
                $model->ano = $ano;
                $model->save();
                return true;
            else:
                return false;
            endif;
        else:
            $total = $empreendimento->estatistica()->where('tipo', $tipo)->whereBetween('created_at', [$data_inicial, $data_final])->count();      
            $model = $this;
            $model->empreendimento_id = $empreendimento->id;
            $model->tipo = $tipo;
            $model->total = $total;
            $model->mes = $mes;
            $model->ano = $ano;
            $model->save();
            return true;
        endif;
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
