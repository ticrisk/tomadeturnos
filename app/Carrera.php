<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carreras';
    //protected $primaryKey = 'id_pais';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User');
    }   
}
