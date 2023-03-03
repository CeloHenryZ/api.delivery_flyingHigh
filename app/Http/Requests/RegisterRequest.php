<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nome'  => 'string|required',
            'cpf'   => 'cpf|required|unique:app_user',
            'password' => 'required|string',
            'remember' => 'required|boolean',

            'contato.email'    => 'email|required',
            'contato.telefone' => 'celular_com_ddd|required',

            'endereco_entrega.id_bairro'   => 'integer|required',
            'endereco_entrega.rua'         => 'string|required',
            'endereco_entrega.numero'      => 'integer|required',

        ];
    }
}
