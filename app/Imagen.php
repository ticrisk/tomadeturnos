<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'imagenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['link','imagen', 'titulo', 'descripcion', 'tipo', 'estado', 'user_id'];

    public $timestamps = true;

    public function imagen()
    {
        return $this->belongsTo('App\Imagen');
    }

}
