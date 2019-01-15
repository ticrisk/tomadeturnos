<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImagenRequest extends Request
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
            'link'    =>  'string|min:3|max:100|required|unique:imagenes',
            'titulo'    =>  'string|min:3|max:200|required',
            'descripcion'    =>  'string|min:3|max:2000|required',
            'estado'  =>  'in:Activo,Privado',
            'tipo'  =>  'in:Meme,Frase,Banner,Otra',
            'imagen'      => 'image|mimes:jpg,jpeg,bmp,png,gif|min:1|max:1024',//|size:1024 = Size es mínimo 1024

        ];
    }
}
