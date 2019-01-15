<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadena extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cadenas';
    //protected $primaryKey = 'id_pais';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function locales()
    {
        return $this->hasMany('App\Local');
    }   
}
