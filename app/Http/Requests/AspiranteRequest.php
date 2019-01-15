<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AspiranteRequest extends Request
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
            'codigoPostulacion'    =>  'string|size:16|required',
            'id'    =>  'integer|required',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
}