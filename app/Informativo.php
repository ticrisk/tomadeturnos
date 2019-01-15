<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informativo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'informativos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'descripcion', 'estado', 'tipo', 'user_id'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }



}
