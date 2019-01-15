<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InformativoRequest extends Request
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
            //'planilla_id'  =>  'integer|required',
            'titulo'    =>  'string|min:3|max:250|required',
            'descripcion'    =>  'string|min:3|max:2000|required',
            'estado'  =>  'in:Público,Privado',
            'tipo'  =>  'in:Otra,Index,Locales,Encargados',
        ];
    }
}
