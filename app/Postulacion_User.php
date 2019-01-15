<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulacion_User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'postulacion_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['postulacion', 'estado', 'postulacion_id', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postulacion()
    {
        return $this->belongsTo('App\Postulacion');
    }    


}
