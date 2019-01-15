<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deseado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deseados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['turnoDeseado', 'planilla_turno_user_id'];

    public $timestamps = false;

    public function planilla_turno_user()
    {
        return $this->belongsTo('App\Planilla_Turno_User');
    }

}
