<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'postulaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion', 'cupos', 'inicio', 'termino', 'activarLista', 'local_id'];

    public $timestamps = false;

    public function local()
    {
        return $this->belongsTo('App\Local');
    }

    public function postulacion_user()
    {
        return $this->hasMany('App\Postulacion_User');
    }




}
