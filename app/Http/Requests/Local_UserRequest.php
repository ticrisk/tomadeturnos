<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Local_UserRequest extends Request
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

            'cuposToma'     =>  'integer|min:0|max:255|required',//unsignedTinyInteger
            'cuposPreToma'  =>  'integer|min:0|max:255|required',
            'cuposRepechaje'  =>  'integer|min:0|max:255|required',
            'estado'        =>  'in:Activo,Desvinculado,Suspendido,Deudor|required',
            'rol'           =>  'in:Empaque,Coordinador,Encargado|required',
            'inicioCastigo' =>  'nullable|required_with_all:terminoCastigo|date_format:"Y-m-d H:i:s"|before:terminoCastigo',
            'terminoCastigo'=>  'nullable|required_with_all:inicioCastigo|date_format:"Y-m-d H:i:s"|after:inicioCastigo',
            'local_id'      =>  'integer|required',
            'user_id'       =>  'integer|required',
            
        ];
    }
}
