<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DB;

class PavimentoGaragem extends Model
{
    use CrudTrait, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pavimentos_garagens';
    protected $fillable = ['empreendimento_id', 'construtora_id', 'torre_id', 'nome'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function salvarPavimento($request, $id = null, $construtora_id)
    {
        DB::beginTransaction();

        $pavimento = new PavimentoGaragem();

        if ($id) {
            $pavimento = $this->find($id);
        }

        $torre = Torre::find($request->torre_id);

        $pavimento->construtora_id = $construtora_id;
        $pavimento->empreendimento_id = $torre->empreendimento_id;
        $pavimento->torre_id = $torre->id;
        $pavimento->nome = $request->nome;        

        if (!$id) {
            $pavimento->gerou_garagens = 'Não';
        }

        $pavimento->save();

        if ($pavimento->gerou_garagens == 'Não') {          
            if ($request->vagas_garagem) {                
                $this->gerarGaragens([
                    'empreendimento_id' => $torre->empreendimento_id,
                    'construtora_id' => $torre->construtora_id,
                    'torre_nome' => $torre->nome,
                    'torre_id' => $torre->id,
                    'vagas_garagem' => $request->vagas_garagem,
                    'pavimento' => $pavimento
                ]);

                $pavimento->gerou_garagens = 'Sim';
                $pavimento->save();
            }            
        }

        DB::commit();

        return $pavimento->empreendimento_id;
    }

    public function gerarGaragens(array $parametros)
    {
        $garagens = $parametros['vagas_garagem'];
        $pavimento = $parametros['pavimento'];

        $controle = 1;

        while ($controle <= $garagens) {           
            
            $garagem = new Garagem();
            $garagem->empreendimento_id = $parametros['empreendimento_id'];
            $garagem->construtora_id = $parametros['construtora_id'];
            $garagem->torre_id = $parametros['torre_id'];
            $garagem->pavimento_garagem_id = $pavimento->id;
            $garagem->nome = "{$controle}";
            $garagem->save();

            $controle++;
        }
    }

    public function excluir($request)
    {
        $id = $request->id;

        if ($id) {
            $pavimento = $this->find($id);
            foreach ($pavimento->garagens as $garagem) {
                $garagem->delete();
            }
            $this->destroy($id);
        }

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function construtora()
    {
        return $this->belongsTo('App\Models\Construtora');
    }

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\Empreendimento');
    }

    public function torre()
    {
        return $this->belongsTo('App\Models\Torre');
    }

    public function garagens()
    {
        return $this->hasMany('App\Models\Garagem');
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
