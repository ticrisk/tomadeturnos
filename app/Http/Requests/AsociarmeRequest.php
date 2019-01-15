<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AsociarmeRequest extends Request
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
            'codigo'    =>  'string|size:16|required',
            'local_id'    =>  'integer|required',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
}
