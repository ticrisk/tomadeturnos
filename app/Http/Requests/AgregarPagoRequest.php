<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AgregarPagoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'fechaPago'   =>  'date_format:"Y-m-d"|required',
            'estado'  =>  'in:Aceptado,Pendiente,Rechazado',
            'pagoDesde'   =>  'before:pagoHasta|date_format:"Y-m-d"|required',
            'pagoHasta'  =>  'after:pagoDesde|date_format:"Y-m-d"|required',
            'tipoPago'  =>  'in:Transferencia,Depósito,Efectivo,Pago Online,Pagado por otra Persona,Costo Cero',
            'pagoTotal' =>  'digits_between:1,6|numeric|min:0|max:300000|required',
            'paga'  =>  'in:Encargado,Empaque',
            'comprobante'    =>  'image|mimes:jpg,jpeg,bmp,png|min:1|max:1024',
            'informacionExtra'    =>  'string|nullable|max:1000',
            'local_user_id'  =>  'integer|required'
        ];
    }
}
