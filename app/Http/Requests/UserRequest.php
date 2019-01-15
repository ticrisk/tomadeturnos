<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'email'         => 'email|max:250|required',
            'password'      =>'nullable|between:6,45|Confirmed',
            'password_confirmation'=>'nullable|between:6,45',
            'nombre'        => 'alpha|min:3|max:45|required',//no puedo ingresar espacios regex:[a-z]|
            'apellido'      => 'alpha|min:3|max:45|required',
            'avatar'        => 'image|mimes:jpg,jpeg,bmp,png,gif|min:1|max:1024',//|size:1024 = Size es mínimo 1024  
            'celular'       => 'nullable|digits_between:7,12|numeric',
            'genero'        => 'in:Sin Registro,Masculino,Femenino',
            'hijos'         => 'in:Sin Registro,Si,No',
            'rol'           => 'in:Usuario,Admin',
            'estado'        => 'in:Confirmado,Pendiente,No Confirmado',
            'direccion'     => 'nullable|string|max:45',
            'redSocial'     => 'nullable|max:250|url',
            'comuna_id'     => 'nullable|integer',
            'carrera_id'    => 'nullable|integer',
            'universidad_id'=> 'nullable|integer',
            'ultimaConexion'=> 'date',
            'created_at'    => 'date',
            'updated_at'    => 'date'

            //'password'  =>'Required|AlphaNum|Between:4,8|Confirmed',
            //'password_confirmation'=>'Required|AlphaNum|Between:4,8'
            /*
            Para solucionar el problema de abajo se debe modificar el php.ini de "/etc/php/70/cli/" con los siguientes datos:
            memory_limit = 34M
            post_max_size = 33M
            upload_max_filesize = 32M
            max_execution_time 600  

            Problema = The file "laravel-5-for-beginners-laraboot.pdf" exceeds your upload_max_filesize ini directive (limit is 2048 KiB).

            */
            
            //MethodNotAllowedHttpException in RouteCollection.php line 219:
            /* <form action="upload" enctype="multipart/form-data" method="post"> Upload image: <input id="image-file" type="file" name="file" /> <input type="submit" value="Upload" /> <script type="text/javascript"> $('#image-file').bind('change', function() { alert('This file size is: ' + this.files[0].size/1024/1024 + "MB"); }); </script> </form> 
            */

        ];
    }
}
