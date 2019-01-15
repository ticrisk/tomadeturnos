<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bolsa extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bolsas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cantidad', 'tamano',  'planilla_turno_user_id'];

    public $timestamps = true;

    public function planilla_turno_user()
    {
        return $this->belongsTo('App\Planilla_Turno_User');
    }

}
