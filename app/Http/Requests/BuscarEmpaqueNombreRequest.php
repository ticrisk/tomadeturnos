<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BuscarEmpaqueNombreRequest extends Request
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
            'nombre'        => 'alpha|min:3|max:45|required',//no puedo ingresar espacios regex:[a-z]|
            'id_local'=> 'integer|required',
        ];
    }
}
