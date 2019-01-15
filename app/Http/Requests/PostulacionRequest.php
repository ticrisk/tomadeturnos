<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostulacionRequest extends Request
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
            'descripcion'    =>  'string|min:3|max:2000|required',
            'activarLista'  =>  'in:Privada,Pública,Azar',
            'inicio'   =>  'before:termino|date_format:"Y-m-d H:i:s"|required',
            'termino'  =>  'after:inicio|date_format:"Y-m-d H:i:s"|required',
            'cupos'    =>  'integer|min:1|max:250|required',
            'local_id' => 'integer|required',
        ];
    }
}
