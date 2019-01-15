<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AgregarTurnoRequest extends Request
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
            'inicio'   =>  'before:termino|date_format:"H:i"|required',
            'termino'  =>  'after:inicio|date_format:"H:i"|required',
            'cupos'    =>  'integer|min:0|max:250|required',
            'planilla_id'  =>  'integer|required',
            'dia.mon'  =>  'in:lunes',
            'dia.tue'  =>  'in:martes',
            'dia.wed'  =>  'in:miercoles',
            'dia.thu'  =>  'in:jueves',
            'dia.fri'  =>  'in:viernes',
            'dia.sat'  =>  'in:sabado',
            'dia.sun'  =>  'in:domingo',
            'dia' => 'required'
        ];
    }
}
