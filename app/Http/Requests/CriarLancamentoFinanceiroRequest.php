<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriarLancamentoFinanceiroRequest extends FormRequest
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
            'construtora_id' => 'required',
            'valor' => 'required',
            'vencimento' => 'required',
            'gerar_nf' => 'required'               
        ];
    }

    public function messages()
    {
        return [
            'construtora_id.required' => 'O campo construtora é obrigatório',
        ];
    }
}
