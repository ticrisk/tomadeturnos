<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AsignarTurnoRequest extends Request
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
            'planilla_id' => 'integer|required',
            'turno_id' => 'integer|required',
            'local_user_id' => 'integer|required',
            'coordinador'  =>  'in:Si,No',
            'fijo'  =>  'in:Si,No',
        ];
    }
}
