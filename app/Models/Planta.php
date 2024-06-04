<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Caracteristica;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DB;

class Planta extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'plantas';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['construtora_id', 'empreendimento_id', 'torre_id', 'nome', 'observacoes', 'status'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function caracteristicasPlanta($planta = null)
    {
        $itens = Caracteristica::where('tipo', 'Planta')->where('exibir', 'Sim')->get()->toArray();

        return array_map(function ($item) use ($planta) {
            
            $existe = false;

            if ($planta) {
                $existe = $planta->caracteristicas->where('id', $item['id'])->toArray();    
            }
            
            if ($existe) {                
                $item['selected'] = 'true';
            } else {
                $item['selected'] = 'false';
            }

            return $item;
        }, $itens);
    }

    public function salvarPlanta($request, $id = null, $construtora_id)
    {
        DB::beginTransaction();

        $planta = new Planta();

        if ($id) {
            $planta = $this->find($id);    
        }

        if ($request->nome) {
            $planta->nome = $request->nome;    
        }
        
        $planta->construtora_id = $construtora_id;    
        $planta->empreendimento_id = $request->empreendimento_id;

        if ($request->area_privativa) {
            $planta->area_privativa = $request->area_privativa;
        }

        $planta->save();        

        $this->salvarItensPlanta($request, $planta);

        $caracteristicas = [
            'qtd_dormitorio',
            'qtd_suite',
            'qtd_banheiro',
            'planta_tipo',
            'vagas_garagem',
            'tipo_garagem',
            'formato_garagem',
            'possui_copa',
            'laje_tecnica'
        ];

        atribuir_caracteristica($request, $planta, 'Planta', $caracteristicas);

        $this->uploadPlantas($planta, $request);

        (new EmpreendimentoPerfil())->marcarPerfil($planta->empreendimento_id, 'Plantas');

        DB::commit();        

        return $planta->empreendimento_id;
    }

    public function salvarItensPlanta($request, $planta)
    {
        $caracteristicas = $request->caracteristicas;
        
        $delete = $planta->caracteristicas()->where('tipo', 'Planta')->where('exibir', 'Sim')->get()->toArray();

        foreach ($delete as $item) {
            $planta->caracteristicas()->detach($item['id']);            
        }

        if ($caracteristicas) {            
            foreach ($caracteristicas as $caracteristica) {                
                $planta->caracteristicas()->attach($caracteristica);
            }
        }
    }

    public function uploadPlantas($planta, $request)
    {       
        $parametros = [
            'arquivos' => [
                'foto_planta',
                'foto_primeira_planta',
                'foto_segunda_planta',
                'foto_terceira_planta'
            ],
            'planta_id' => $planta->id,
            'empreendimento_id' => $planta->empreendimento_id,
            'construtora_id' => $planta->construtora_id,
            'request' => $request
        ];

        return (new Foto())->salvarFotos($parametros);        
    }

    public function excluir($request)
    {
        $id = $request->id;

        if ($id) {
            $planta = $this->find($id);
            $planta->caracteristicas()->detach();
            $this->destroy($id);
        }

        return true;
    }

    public function getFotoDestaque()
    {
        if ($this->foto_planta) {
            return Foto::find($this->foto_planta);
        }
    }

    public function getUrlById($id, $tipo = 'original')
    {
        $foto = Foto::find($id);
        if ($foto) {
            return $foto->getUrl($tipo);    
        }        
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function fotos()
    {
        return $this->hasMany('App\Models\Foto', 'planta_id');
    }

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_plantas')->withPivot('valor');
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
