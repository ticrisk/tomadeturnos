<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'local_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cuposToma', 'cuposPreToma', 'cuposRepechaje', 'estado', 'rol', 'inicioCastigo', 'terminoCastigo', 'local_id', 'user_id'];

    public $timestamps = false;

    public function local()
    {
        return $this->belongsTo('App\Local');
    }   

    public function user()
    {
        return $this->belongsTo('App\User');
    }   

    public function faltas()   
    {
        return $this->hasMany('App\Falta');
    }

    public function planilla_turno_user()   
    {
        return $this->hasMany('App\Planilla_Turno_User');
    }    

    public function noticias()
    {
        return $this->hasMany('App\Noticia');
    }      

}
