<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'noticias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'descripcion', 'estado', 'local_id', 'local_user_id'];

    public $timestamps = true;

    public function local()
    {
        return $this->belongsTo('App\Local');
    }   

    public function local_user()
    {
        return $this->belongsTo('App\Local_User');
    }       
}
