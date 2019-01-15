<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\MyResetPassword;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rut', 'email', 'nombre', 'apellido', 'estado', 'rol', 'ultimaConexion', 'direccion', 'celular', 'genero', 'hijos', 'avatar', 'redSocial', 'password', 'comuna_id', 'carrera_id', 'universidad_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public $timestamps = true;

    public function getFullnameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    public function comuna()
    {
        return $this->belongsTo('App\Comuna');
    }  

    public function carrera()
    {
        return $this->belongsTo('App\Carrera');
    }

    public function universidad()
    {
        return $this->belongsTo('App\Universidad');
    }    
   

    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }       

    public function imagenes()
    {
        return $this->hasMany('App\Imagen');
    }   

    public function informativos()
    {
        return $this->hasMany('App\Informativo');
    }

    public function postulacion_user()
    {
        return $this->hasMany('App\Postulacion_User');
    }

    public function local_user()
    {
        return $this->hasMany('App\Local_User');
    }   

    //Buscardor de admin/usuarios
    public function scopeBuscarUsuario($query, $nombre)
    {
        return $query->where('rut', 'LIKE' ,"%$nombre%")
                     ->orWhere('id', 'LIKE' ,"%$nombre%")
                     ->orWhere('nombre', 'LIKE', "%$nombre%")
                     ->orWhere('apellido', 'LIKE', "%$nombre%");
    }

}
