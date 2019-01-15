<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateImagenRequest extends Request
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
            'link'    =>  'string|min:3|max:100|required',
            'titulo'    =>  'string|min:3|max:200|required',
            'descripcion'    =>  'string|min:3|max:2000|required',
            'tipo'  =>  'in:Meme,Frase,Banner,Otra',
            'estado'  =>  'in:Activo,Privado',
            'imagen'      => 'image|mimes:jpg,jpeg,bmp,png,gif|max:1024',//|size:1024 = Size es mínimo 1024
            'imgDescripcion'      => 'image|mimes:jpg,jpeg,bmp,png,gif|max:1024',//|size:1024 = Size es mínimo 1024
          
        ];
    }
}
