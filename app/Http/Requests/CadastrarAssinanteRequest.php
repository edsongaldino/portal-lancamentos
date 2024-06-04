<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CadastrarAssinanteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            //'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'construtora' => 'required',
            //'cnpj' => 'required|unique:construtoras',
            'logradouro' => 'required',
            'numero' => 'required',
            'cep' => 'required',
            'estado_id' => 'required',
            'cidade_id' => 'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => 'O campo senha é obrigatório',
            'password.confirmed' => 'As duas senham precisam ser idênticas',
            'estado_id.required' => 'Estado é obrigatório' ,
            'cidade_id.required' => 'Cidade é obrigatório' ,
            'email.unique' => 'Já existe um cadastro associado a este e-mail no sistema',
            'cnpj.unique' => 'Já existe um cadastro associado a este CNPJ no sistema',
        ];
    }
}
