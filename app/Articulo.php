<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articulos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['link', 'titulo', 'descripcion', 'texto', 'texto2', 'portada', 'imgDescripcion', 'estado', 'user_id'];
    //portada es la imagen del artículo
    //falta agregar el link(unico),  estado.
    //protected $fillable = ['link', 'titulo', 'imagen', 'texto_uno', 'texto_dos', 'texto_tres', 'descripcion', 'estado', 'tipo', 'linkFacebook', 'linkTwitter', 'imagenFacebook', 'user_id'];

    public $timestamps = true;



    public function user()
    {
        return $this->belongsTo('App\User');
    }    

}
