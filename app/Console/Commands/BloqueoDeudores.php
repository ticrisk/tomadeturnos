<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Pago;
use App\Local;
use App\Local_User;
use App\Planilla_Turno_User;

class BloqueoDeudores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:bloqueo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambiar de estado a "deudores" los empaques que no registran pagos en el mes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$firstDayLastMonth = date('Y-m-d', mktime(0,0,0, date('m', strtotime(date('Y-m-d').' - 1 month')), 1, date('Y')));
        $firstDayLastMonth = date('Y-m-d', strtotime('first day of last month',time()));
        //$lastDayLastMonth = date('Y-m-d', mktime(0,0,0, date('m', strtotime(date('Y-m-d').' - 1 month')) + 1, 0, date('Y')));
        $lastDayLastMonth = date('Y-m-d', strtotime('last day of last month', time()));

        $locales = Local::where('cuenta', 'Premium')->where('estado', 'Activo')->where('precioMensual', '>', 0)->get();//->where('responsablePago', 'Empaques')

        foreach ($locales as $local){

            if($local->responsablePago == 'Empaques') {

                $idDeudores = array();//id de los empaques que se cambiará a deudores
                $emailDeudores = array();//emails de personas que se les cambió el estado a deudores
                $emailCostoCero = array();//emails para informar que no tienen que pagar nada
                $idUserPagosPendientes = array();//se genera un registro de pago como pendiente
                $idUserPagosAceptados = array();//se genera un registro de pago como aceptado

                //Selecciono el idUserLocal y el email de todos los empaques del local
                $empaques = Local_User::select('local_user.id as id', 'local_user.estado as estado', 'users.email')
                    ->where('local_user.local_id', $local->id)
                    ->join('users', 'users.id', '=', 'local_user.user_id')
                    ->get();


                foreach ($empaques as $empaque) {

                    //verifico si tomó algun turno en el mes correspondiente a la boleta.
                    $turnTaken = Planilla_Turno_User::where('local_user_id', $empaque->id)
                        ->where('created_at', '>=', $firstDayLastMonth)
                        ->where('created_at', '<=', $lastDayLastMonth)
                        ->first();

                    //Reviso si el empaque tiene algún pago en el mes correspondiente a la boleta. (Incluye pago del encargado)
                    $pagos = Pago::where('local_user_id', $empaque->id)
                        ->where('estado', 'Aceptado')
                        ->where('pagoDesde', '<=', $firstDayLastMonth)
                        ->where('pagoHasta', '>=', $lastDayLastMonth)
                        ->first();

                    //Se bloquea y se envía el email, si tomó un turno en el rango de fecha y si No existe un pago en ese rango de fecha.
                    //Si es así, los dejo como Deudor y creo una boleta de pago como Pendiente.
                    if (count($turnTaken) > 0 && count($pagos) == 0 && $empaque->estado != 'Desvinculado') {
                        //Es un usuario deudor, se genera y envía boleta como pendiente, tbn se cambia el estado a deudor
                        $idDeudores[] = $empaque->id;
                        $idUserPagosPendientes[] = array('estado' => 'Pendiente',
                            'pagoTotal' => $local->precioMensual,
                            'fechaPago' => date('Y-m-d'),
                            'tipoPago' => 'Transferencia',
                            'pagoDesde' => $firstDayLastMonth,
                            'pagoHasta' => $lastDayLastMonth,
                            'comprobante' => null,
                            'informacionExtra' => null,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'paga' => 'Empaque',
                            'local_user_id' => $empaque->id);
                        $emailDeudores[] = $empaque->email;

                    } elseif (count($turnTaken) > 0 && count($pagos) == 0 && $empaque->estado == 'Desvinculado') {
                        //Es un usuario deudor, se genera y envía boleta como pendiente, se mantiene el estado como desvinculado'
                        $idUserPagosPendientes[] = array('estado' => 'Pendiente',
                            'pagoTotal' => $local->precioMensual,
                            'fechaPago' => date('Y-m-d'),
                            'tipoPago' => 'Transferencia',
                            'pagoDesde' => $firstDayLastMonth,
                            'pagoHasta' => $lastDayLastMonth,
                            'comprobante' => null,
                            'informacionExtra' => null,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'paga' => 'Empaque',
                            'local_user_id' => $empaque->id);
                        $emailDeudores[] = $empaque->email;

                    } elseif (count($turnTaken) == 0 && count($pagos) == 0 && $empaque->estado != 'Desvinculado') {
                        //El empaque no tomó turno y no hay pagos en esa fecha, se genera una boleta por costo 0 como Aceptado, el estado se mantiene y se manda boleta de costo cero
                        $idUserPagosAceptados[] = array('estado' => 'Aceptado',
                            'pagoTotal' => 0,
                            'fechaPago' => date('Y-m-d'),
                            'tipoPago' => 'Costo Cero',
                            'pagoDesde' => $firstDayLastMonth,
                            'pagoHasta' => $lastDayLastMonth,
                            'comprobante' => null,
                            'informacionExtra' => 'No tomó turnos en el mes.',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'paga' => 'Empaque',
                            'local_user_id' => $empaque->id);
                        $emailCostoCero[] = $empaque->email;

                    }//elseif(count($turnTaken)>=0 && count($pagos)>0 && $empaque->estado != 'Desvinculado'){
                    //El empaque tomó o no tomó turno y el usuario tiene pagado el mes, el estado se mantiene, no se manda boleta y no se agrega un registro de pago.
                    //}
                    //si el empaque no  tomó turnos, pagó y esta desvinculado, No pasa nada, no se genera ni se envía boleta ni se le cambia el estado
                    //si el empaque Si  tomó turnos, pagó y esta desvinculado, No pasa nada, no se genera ni se envía boleta ni se le cambia el estado
                    //si el empaque no tomó turnos, no pagó y esta desvinculado, se mantiene desvinculado, no se genera ni se envia boleta
                }

                //Todos los deudores pasan de activos/suspendidos/deudor a deudor  (Desvinculado No)
                Local_User::whereIn('id', $idDeudores)->update(array('estado' => 'Deudor'));

                //Agrego registros de pagos por usuario como pendientes
                Pago::insert($idUserPagosPendientes);

                //Agrego registros de pagos por usuario como Aceptados (Los que NO tomaron turnos y no se les cobra nada).
                Pago::insert($idUserPagosAceptados);

                //Envio un email informando que su cuenta fue bloqueada
                /**/
                Mail::send('vendor.notifications.email-usuario-bloqueado', [], function ($msj) use ($emailDeudores) {
                    $msj->to($emailDeudores)->subject('Bloqueo de cuenta - Proyecto Nero');
                });

            }else{
                //El responsable es el encargado

                //Reviso el último pago realizado por el encargado
                $pagos = Pago::where('pagos.estado', 'Aceptado')
                    ->where('paga', 'Encargado')
                    ->where('pagos.pagoDesde', '<=', $firstDayLastMonth)
                    ->where('pagos.pagoHasta', '>=', $lastDayLastMonth)
                    ->join('local_user', 'local_user.id', '=', 'pagos.local_user_id')
                    ->where('local_user.local_id', $local->id)
                    ->first();

                //Si no se encuentran pagos Aceptados en el super
                if(count($pagos)==0){
                    //Creo boleta pendiente resp.enc., bloqueo, envio email a los encargados que se bloqueó el local

                    //Selecciono el idUserLocal y el email de todos los empaques del local
                    $infoEncargados = Local_User::select('local_user.id as idLocalUser', 'users.email')
                        ->where('local_user.local_id', $local->id)
                        ->where('local_user.estado', '!=', 'Desvinculado')
                        ->where('local_user.rol', 'Encargado')
                        ->join('users', 'users.id', '=', 'local_user.user_id')
                        ->get();

                    $emailsEncargados = $infoEncargados->pluck('email')->toArray();

                    //Cantidad de usuarios que tomaron por lo menos 1 turno en el mes.
                    $cantUserTakenTurn = Local_User::select('local_user.id as idLocalUser')
                        ->join('planilla_turno_user', 'planilla_turno_user.local_user_id', '=', 'local_user.id')
                        ->where('planilla_turno_user.created_at', '>=', $firstDayLastMonth)
                        ->where('planilla_turno_user.created_at', '<=', $lastDayLastMonth)
                        ->distinct('planilla_turno_user.local_user_id')
                        ->get();

                    //Genero pago pendiente, debe haber por lo menos 1 encargado en el local
                    if(count($infoEncargados)>0){
                        $idLocalUser = $infoEncargados[0]['idLocalUser'];

                        Pago::create(array('estado' => 'Pendiente',
                            'pagoTotal' => $local->precioMensual * count($cantUserTakenTurn),
                            'fechaPago' => date('Y-m-d'),
                            'tipoPago' => 'Transferencia',
                            'pagoDesde' => $firstDayLastMonth,
                            'pagoHasta' => $lastDayLastMonth,
                            'comprobante' => null,
                            'informacionExtra' => null,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'paga' => 'Encargado',
                            'local_user_id' => $idLocalUser));
                    }

                    //Bloqueo el local
                    Local::where('id', $local->id)->update(['estado' => 'Bloqueado']);

                    //Envio emails a los encargados
                    /**/
                    Mail::send('vendor.notifications.email-local-bloqueado', [], function ($msj) use ($emailsEncargados) {
                        $msj->to($emailsEncargados)->subject('Bloqueo del Local - Proyecto Nero');
                    });




                }

                /*
                 * Caso 1 =
                 *      Situación: Mes a mes en el Crontab reviso pagos Aceptados y que paga el Enc. del mes pasado.
                 *      Solución: Se bloquea a los locales que no tienen ningún pago registrados, se crea una boleta como pendientes correspondiente al mes
                 *                  anterior. De lo contrario no se hace nada.
                 *
                 * Caso 2 =
                 *      Situación: El local Premium pasa de pagoMensual $0 a $+500.
                 *      Solución: Hacer el cambio de pagoMensual después del Crontab, así se cobra en el Crontab del siguiente mes,
                 *                  de lo contrario el local se bloqueará. Ej: Debería pagar $0 del 01/02/2018 al 28/02/2018, y en el mes de Marzo debería
                 *                  pagar $500. Si realizo el cambio antes del Crontab de Marzo, se aplica el caso 1 y revisará pagos del mes anterior, por lo
                 *                  cual se bloqueará el local ya que no encontrará ninguna boleta. En cambio, si se realiza después del crontab de Marzo, el
                 *                  local seguirá intacto hasta el siguiente Crontab de Abril, en el cual se proseguirá a cobrar el mes de Marzo, generando
                 *                  una boleta Pendiente si es que no ha pagado (Aplicando el caso 1).
                 *
                 * Caso 3 =
                 *      Situación: Cambiar el responsable de pago de Emp. a Enc. o de Free a Premium
                 *      Solución:  No debe haber emp. deudores  y debe hacerse después del Crontab. De lo contrario se produce bloqueo del local o se cobra en
                 *                  en un mes que debería ser pago $0.                 *
                 */


            }
        }

    }
}
