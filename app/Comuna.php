<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comunas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'region_id'];

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }    

    /*
        Función para buscar comunas segun ID del dropdownlist de la regiión.
    */
    public static function buscarComunas($id)
    {
        return Comuna::where('region_id','=',$id)->get();
    }
}
