<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planilla_Turno_User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'planilla_turno_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fijo', 'coordinador', 'tipo', 'estado', 'exTipo', 'exDueno_id', 'group_change', 'planilla_id', 'turno_id', 'local_user_id'];

    public $timestamps = true;


    public function exDueno_id()
    {
        return $this->belongsTo('App\Local_User');
    }

    public function planilla()
    {
        return $this->belongsTo('App\Planilla');
    }

    public function turno()
    {
        return $this->belongsTo('App\Turno');
    }  

    public function local_user()
    {
        return $this->belongsTo('App\Local_User');
    }   

    public function bolsas()     
    {
        return $this->hasMany('App\Bolsa');
    }

    public function deseados()     
    {
        return $this->hasMany('App\Deseado');
    }

}
