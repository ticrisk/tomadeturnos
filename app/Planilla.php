<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'planillas';
    //protected $primaryKey = 'id_pais';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['inicioPlanilla', 'finPlanilla', 'inicioToma', 'finToma', 'inicioRepechaje', 'finRepechaje', 'inicioPreToma', 'finPreToma', 'inicioRepechajeOrganizacion', 'finRepechajeOrganizacion', 'estado', 'local_id'];

    public $timestamps = false;

    public function local()
    {
        return $this->belongsTo('App\Local');
    }   

    public function planilla_turno_user()
    {
        return $this->hasMany('App\Planilla_Turno_User');
    }

    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }    
}
