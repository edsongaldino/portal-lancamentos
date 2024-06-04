<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContatoConstrutora extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contatos_construtoras';
    protected $fillable = ['construtora_id', 'nome', 'email', 'telefone', 'situacao'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function cadastrar($request, $construtora)
    {
        if ($this->validar($request)) {
            $nomes = array_filter($request->nome_contato);
            $emails = array_filter($request->email_contato);
            $telefones = array_filter($request->telefone_contato);

            foreach ($nomes as $k => $nome) {       
                $contato = $this->create([
                    'construtora_id' => $construtora->id,
                    'nome' => $nome,
                    'email' => isset($emails[$k]) ? $emails[$k] : null,
                    'telefone' => isset($telefones[$k]) ? $telefones[$k] : null,
                    'situacao' => 'Liberada'
                ]);
            }
        }
    }

    public function validar($request)
    {
        $nomes = array_filter($request->nome_contato);
        $emails = array_filter($request->email_contato);
        $telefones = array_filter($request->telefone_contato);

        if (!$nomes || !$emails || !$telefones) {
            return false;
        }

        $total_nomes = count($nomes);
        $total_emails = count($emails);
        $total_telefones = count($telefones);

        if (($total_nomes != $total_emails) || ($total_emails != $total_telefones)) {
            return false;
        }
 
        return true;
    }

    public function atualizar($request, $construtora)
    {
        if ($this->validar($request)) {
            $contatos = $construtora->contatos;  

            foreach ($contatos as $contato) {
                $contato->delete();
            }
            
            $this->cadastrar($request, $construtora);
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
