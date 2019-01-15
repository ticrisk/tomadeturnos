<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactoRequest extends Request
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
            'nombre'    =>  'string|min:3|max:250|required',
            'mensaje'    =>  'string|min:3|max:2000|required',
            'email'  =>  'email|min:3|max:250|required',
            'cantidad'  =>  'integer',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
}
