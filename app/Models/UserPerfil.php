<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BackpackUser;

class UserPerfil extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'users_perfis';
    protected $fillable = ['nome', 'completo'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function gerar($usuario_id)
    {
        $existe = BackpackUser::find($usuario_id)->perfil->toArray();

        if (!$existe) {
            $perfis = [
                'Foto',
                'Informações Pessoais'
            ];

            foreach ($perfis as $item) {
                $existe = $this->where('user_id', $usuario_id)->where('nome', $item)->get()->first();

                if (!$existe) {
                    $perfil = new UserPerfil();
                    $perfil->user_id = $usuario_id;
                    $perfil->nome = $item;
                    $perfil->completo = 'N';
                    $perfil->save();
                }
            }
        }

    }

    public function marcarPerfil($user_id, $nome) 
    {
        $item = $this->where('user_id', $user_id)->where('nome', $nome)->first();

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

    public function usuario()
    {
        return $this->belongsTo('App\Models\BackpackUser');
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
