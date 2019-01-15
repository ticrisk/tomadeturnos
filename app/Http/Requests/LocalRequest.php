<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocalRequest extends Request
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

            'nombre'    =>  'string|min:3|max:45|required',
            'codigo'    =>  'nullable|string|size:16',
            'codigoPostulacion'    =>  'nullable|string|size:16',
            'direccion' =>  'nullable|string|max:45',
            'cuenta'    =>  'in:Free,Premium|required',
            'estado'    =>  'in:Activo,Bloqueado|required',
            'cambiar'    =>  'in:Si,No|required',
            'cambiarHasta'  =>  'integer|min:0|max:20|required',
            'ceder'    =>  'in:Si,No|required',
            'regalarLocal'    =>  'in:Si,No|required',
            'preToma'    =>  'in:Si,No|required',
            'repechajeLocal'    =>  'in:Si,No|required',
            'planillaEmpaque'    =>  'in:Si,No|required',
            'planillaCoordinador'    =>  'in:Si,No|required',
            'cadena_id'    =>  'integer|required',
            'organizacion_id'    =>  'integer|required',
            'visible'    =>  'in:Si,No|required',
            'precioMensual' =>  'digits_between:1,5|numeric|min:0|max:5000|required',
            'responsablePago'    =>  'in:Encargado,Empaques|required',
        ];
    }
}
