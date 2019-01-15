<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'cuenta', 'estado', 'direccion', 'codigo', 'codigoPostulacion', 'planillaEmpaque', 'planillaCoordinador', 'cambiar', 'cambiarHasta', 'ceder', 'regalarLocal', 'preToma', 'repechajeLocal', 'visible', 'precioMensual', 'responsablePago','cadena_id', 'organizacion_id'];//los updateda_at se agregan?

    public $timestamps = false;

    public function cadena()
    {
        return $this->belongsTo('App\Cadena');
    }    

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion');
    }     

    public function local_user()
    {
        return $this->hasMany('App\Local_User');
    } 

    public function postulaciones()
    {
        return $this->hasMany('App\Postulacion');
    }  

    public function planillas()
    {
        return $this->hasMany('App\Planilla');
    }          

    public function noticias()
    {
        return $this->hasMany('App\Noticia');
    } 


           /*
        Función para buscar comunas segun ID del dropdownlist de la regiión.
    */
    public static function buscarLocales($id)
    {
        return Local::where('cadena_id','=',$id)->get();
    }



}
