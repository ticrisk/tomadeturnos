<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Falta extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faltas';
    //protected $primaryKey = 'id_pais';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'descripcion', 'tipo', 'reportador', 'local_user_id'];

    public $timestamps = true;

    //acá puede generar problemas
    public function local_user()
    {
        return $this->belongsTo('App\Local_User');
    }   
}
