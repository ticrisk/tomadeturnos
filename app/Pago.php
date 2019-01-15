<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pagos';
    //protected $primaryKey = 'id_pais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['estado', 'fechaPago', 'pagoDesde', 'pagoHasta', 'tipoPago', 'pagoTotal', 'comprobante', 'informacionExtra', 'paga', 'local_user_id'];

    public $timestamps = true;

    public function local_user()
    {
        return $this->belongsTo('App\Local_User');
    }

}
