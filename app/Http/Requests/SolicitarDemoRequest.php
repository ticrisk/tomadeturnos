<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SolicitarDemoRequest extends Request
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
            'rut'    => 'alpha_dash|min:9|max:10|required',
            'nombre' =>  'alpha|min:3|max:250|required',
            'apellido' =>  'alpha|min:3|max:250|required',
            'email'  =>  'email|min:3|max:250|required|Confirmed',
            'email_confirmation'   => 'email|max:250|required',
            'cadena_id'    =>  'integer|required',
            'nombreLocal'  =>  'string|min:3|max:45|required',
            'cantidad' =>  'integer|min:0|max:1000|required',
            'cobro'    =>  'in:Si,No|required',
            'version'    =>  'in:Free,Premium|required',
            'encontraste'    =>  'in:Google,Noticias,Boca a Boca,Redes Sociales,Tarjeta de Presentación,Otra|required',
            'mensaje'  =>  'string|min:3|max:2000|required',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
}
