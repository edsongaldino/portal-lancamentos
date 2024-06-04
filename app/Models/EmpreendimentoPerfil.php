<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpreendimentoPerfil extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'empreendimentos_perfis';
    protected $fillable = ['nome', 'completo'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function gerar($empreendimento_id)
    {
        $empreendimento = Empreendimento::find($empreendimento_id);
        $existe = $empreendimento->perfil->toArray();

        if (!$existe) {

            if ($empreendimento->tipo == 'Vertical') {
                $tipos = [
                    'Dados do empreendimento',
                    'Endereço',
                    'Itens de Lazer',
                    'Características',
                    'Torres',
                    'Plantas',
                    'Unidades',
                    'Seo'
                ];    
            }

            if ($empreendimento->tipo == 'Horizontal') {
                $tipos = [
                    'Dados do empreendimento',
                    'Endereço',
                    'Itens de Lazer',
                    'Características',
                    'Quadras',
                    'Plantas',
                    'Unidades',
                    'Seo'
                ];    
            }        

            foreach ($tipos as $nome) {

                $existe = $this->where('empreendimento_id', $empreendimento_id)->where('nome', $nome)->get()->first();

                if (!$existe) {
                    $perfil = new EmpreendimentoPerfil();
                    $perfil->empreendimento_id = $empreendimento_id;
                    $perfil->nome = $nome;
                    $perfil->save();
                }
            }
        }
    }

    public function marcarPerfil($empreendimento_id, $nome) 
    {
        $item = $this->where('empreendimento_id', $empreendimento_id)->where('nome', $nome)->first();

        if ($item) {
            $item->completo = 'S';
            $item->save();
        }
    }

    public function getPercentual($perfil)
    {
        if ($perfil) {
            $completos = function ($perfil) {
                $totalCompletos = 0;
                foreach ($perfil as $p) {
                    if ($p['completo'] == 'S') {
                        $totalCompletos++;
                    }
                }

                return $totalCompletos;
            };

            $total = count($perfil);

            return ceil(($completos($perfil) / $total) * 100);
        }

        return 0;
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
