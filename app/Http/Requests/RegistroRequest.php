<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroRequest extends Request
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
            //'regex:[a-z]'
            //'between:7,20' ->valor entre 7 a 20
            //digits_between:7,20  -> debe contener entre 7 a 20 caracteres
            //alpha->solo letras | alpha_dash->letras, números y guiones (a-z, 0-9, -_)
            //'username'  => 'required|min:1|max:45|unique:users,username',
            //'email'     =>  'required|email|min:5|max:250|unique:users,email',//unique:tabla,columna
            'rut'           => 'alpha_dash|min:9|max:10|required|unique:users,rut',//11234567-9
            'email'         => 'email|max:250|required|unique:users,email|Confirmed',
            'email_confirmation'         => 'email|max:250|required|unique:users,email',
            'password'      =>'between:6,45|Confirmed',
            'password_confirmation'=>'between:6,45',
            'nombre'        => 'alpha|min:3|max:45|required',//no puedo ingresar espacios regex:[a-z]|
            'apellido'      => 'alpha|min:3|max:45|required',
                   


        ];
    }
}
