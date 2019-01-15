<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlanillaRequest extends Request
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

            'id'          =>  'integer|required',

            'inicioPlanilla'    =>  'required_with_all:finPlanilla|date_format:"Y-m-d"|before:finPlanilla',
            'finPlanilla'       =>  'required_with_all:inicioPlanilla|date_format:"Y-m-d"|after:inicioPlanilla',

            'inicioToma'        =>  'required|required_with_all:finToma|date_format:"Y-m-d H:i:s"|before:finToma',
            'finToma'           =>  'required|required_with_all:inicioToma|date_format:"Y-m-d H:i:s"|after:inicioToma',

            'inicioPreToma'        =>  'nullable|required_with_all:finPreToma|date_format:"Y-m-d H:i:s"|before:finPreToma',
            'finPreToma'           =>  'nullable|required_with_all:inicioPreToma|date_format:"Y-m-d H:i:s"|after:inicioPreToma',

            'inicioRepechaje'   =>  'nullable|required_with_all:finRepechaje|date_format:"Y-m-d H:i:s"|before:finRepechaje',
            'finRepechaje'      =>  'nullable|required_with_all:inicioRepechaje|date_format:"Y-m-d H:i:s"|after:inicioRepechaje',

            //'local_id'          =>  'integer|required',
            
        ];
    }
}
