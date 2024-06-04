<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Construtora;

class ConstrutoraPerfil extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'construtoras_perfis';
    protected $fillable = ['nome', 'completo'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function gerar($construtora_id)
    {
        $existe = Construtora::find($construtora_id)->perfil->toArray();

        if (!$existe) {
            $perfis = [                
                'Informações da Construtora',
                'Endereço da construtora',
                'Canais de atendimento',
                'Redes Sociais'
            ];
            
            foreach ($perfis as $item) {

                $existe = $this->where('construtora_id', $construtora_id)->where('nome', $item)->get()->first();

                if (!$existe) {
                    $perfil = new ConstrutoraPerfil();
                    $perfil->construtora_id = $construtora_id;
                    $perfil->nome = $item;
                    $perfil->completo = 'N';
                    $perfil->save();
                }
            }
        }
    }

    public function marcarPerfil($construtora_id, $nome) 
    {
        $item = $this->where('construtora_id', $construtora_id)->where('nome', $nome)->first();

        if ($item) {
            $item->completo = 'S';
            $item->save();
        }
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
