<?php

namespace App\Http\Requests;

use App\Rules\validatorMoney;
use Illuminate\Foundation\Http\FormRequest;

class BairroRequest extends FormRequest
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
            "nome" => "required|string",
            "valor_frete" => ["required", new validatorMoney()]
        ];
    }
}
