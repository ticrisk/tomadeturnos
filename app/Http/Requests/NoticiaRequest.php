<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NoticiaRequest extends Request
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
            'descripcion'    =>  'string|min:3|max:500|required',
            'estado'  =>  'in:Público,Oculto',
            //'created_at'    => 'date_format:"Y-m-d H:i:s"|required',
            //'updated_at'    => 'date_format:"Y-m-d H:i:s"|required',
            'local_id' => 'integer|required',
            'local_user_id' => 'integer|required',
        ];
    }
}
