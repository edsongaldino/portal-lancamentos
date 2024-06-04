<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DB;
use App\Models\Empreendimento;

class Quadra extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'quadras';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['empreendimento_id', 'nome', 'total_unidades', 'previsao_entrega', 'nomenclatura', 'observacoes', 'status', 'gerou_unidades'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarQuadra($request, $id = null, $construtora_id)
    {
        $quadra = new Quadra();

        if ($id) {
            $quadra = $this->find($id);
        }

        $quadra->nome = $request->nome;
        $quadra->construtora_id = $construtora_id;
        $quadra->empreendimento_id = $request->empreendimento_id;
        $quadra->total_unidades = $request->total_unidades;
        $quadra->previsao_entrega_mes = $request->previsao_entrega_mes;
        $quadra->previsao_entrega_ano = $request->previsao_entrega_ano;
        $quadra->nomenclatura = $request->nomenclatura;
        $quadra->status = $request->status;        

        if (!$id) {
            $quadra->gerou_unidades = 'Não';
        }

        $quadra->save();

        if ($quadra->gerou_unidades == 'Não') {
            $this->gerarUnidades(1, $quadra, $construtora_id, $quadra->empreendimento_id);    
        }

        (new EmpreendimentoPerfil())->marcarPerfil($quadra->empreendimento_id, 'Quadras');
        (new EmpreendimentoPerfil())->marcarPerfil($quadra->empreendimento_id, 'Unidades');

        return $quadra->empreendimento_id;
    }

    public function excluir($request)
    {
        $id = $request->id;

        if ($id) {
            $quadra = $this->find($id);
            foreach ($quadra->unidades as $unidade) {
                $unidade->delete();
            }
            $this->destroy($id);
        }

        return true;
    }

    public function excluirQuadrasUnidades($request)
    {
        $empreendimento = Empreendimento::find($request->empreendimento_id);
        $quadras = $empreendimento->quadras;

        if ($quadras) {
            foreach ($quadras as $quadra) {
                foreach ($quadra->unidades as $unidade) {
                    $unidade->delete();
                }
                $this->destroy($quadra->id);
            }

            $empreendimento->gerou_unidades = 'Não';
            $empreendimento->save();
        }

        return true;
    }

    public function gerarQuadrasUnidades($quadras, $unidades, $nomenclatura, $empreendimento_id, $construtora_id)
    {
        try {            
            if ($quadras) {                                
                DB::beginTransaction();
                $quadra = 1;
                while ($quadra <= $quadras) {
                    $unidade = 1;
                    
                    $q = new Quadra();

                    $existe = Quadra::where('construtora_id', $construtora_id)->where('empreendimento_id', $empreendimento_id)->where('nome', "Quadra {$quadra}")->first();

                    if ($existe) {
                        $q = $existe;
                    }

                    $q->construtora_id = $construtora_id;
                    $q->empreendimento_id = $empreendimento_id;
                    $q->nomenclatura = $nomenclatura;
                    $q->total_unidades = $unidades;
                    $q->nome = "Quadra {$quadra}";
                    $q->save();
                    $this->gerarUnidades($unidade, $q, $construtora_id, $empreendimento_id);

                    $quadra++;
                }

                DB::commit();
                
                return true;
            }

        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function gerarUnidades($unidade, $quadra, $construtora_id, $empreendimento_id)
    {        
        $numero = 1;    

        while ($unidade <= $quadra->total_unidades) {
            (new Unidade())->novaUnidadeHorizontal($numero, $quadra->id, $construtora_id, $empreendimento_id);
            $unidade++;
            $numero++;
        }

        $quadra->gerou_unidades = 'Sim';
        $quadra->save();
    }

    public function getNumeroUltimaUnidade($empreendimento_id)
    {
        $unidades = Empreendimento::find($empreendimento_id)->unidades;
        
        if ($unidades->first()) {
            return $unidades->last()->nome + 1;
        }

        return 1;
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

    public function tabelas()
    {
        return $this->hasMany('App\Models\TabelaVendas');
    }
    
    public function unidades()
    {
        return $this->hasMany('App\Models\Unidade');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica', 'caracteristicas_quadras')->withPivot('valor');
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
