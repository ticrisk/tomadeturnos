<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'turnos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'inicio', 'termino', 'cupos', 'planilla_id'];

    public $timestamps = false;


    public function planilla_turno_user()
    {
        return $this->hasMany('App\Planilla_Turno_User');
    }  

    public function planilla()
    {
        return $this->belongsTo('App\Planilla');
    }        
}
