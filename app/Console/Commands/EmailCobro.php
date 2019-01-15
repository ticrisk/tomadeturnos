<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

use App\Pago;
use App\Local;
use App\Local_User;
use App\Planilla_Turno_User;

class EmailCobro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cobro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar un email de cobranza el primer día del mes a las 12:00:00 hrs';

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
        $locales = Local::where('cuenta', 'Premium')->where('estado', 'Activo')->where('precioMensual', '>', 0)->get();
        //dd($locales);
        foreach ($locales as $local){
            if($local->responsablePago == 'Encargado'){

                //obtengo los emails de los encargados del local
                $emailsEncargados = Local_User::select('users.email')
                    ->where('local_user.rol', 'Encargado')
                    ->where('local_user.estado', '!=','Desvinculado')
                    ->where('local_user.local_id', $local->id)
                    ->join('users', 'local_user.user_id', '=', 'users.id')
                    ->pluck('users.email')
                    ->toArray();

                //A la fecha actual que se ejecuta el CRONTAB le resto 1 mes para obtener la fecha del mes anterior a la que se cobrara
                $mesCobrar  = date ( 'Y-m-d' , strtotime ( '-1 month' , strtotime(date('Y-m-d'))) );
                $mes= date('m', strtotime($mesCobrar));
                $ano= date('Y', strtotime($mesCobrar));
                //Obtengo el primer día del mes/año
                $firstDay = date('Y-m-d', mktime(0,0,0, date($mes), 1, date($ano)));
                //Obtengo el ultimo día del mes/año
                $lastDay = date('Y-m-d', mktime(0,0,0, date($mes) +1, 0, date($ano)));
                //selecciono los ids de los empaques de un local (incluyendo los desvinculados)
                $idUsers = Local_User::select('id')->where('local_id', $local->id)->get();
                //obtengo la información de los empaques que tomaron 1 o más turnos
                $infoUsers = Planilla_Turno_User::select('local_user.estado', 'local_user.id as idUserLocal', 'users.rut', 'users.nombre', 'users.apellido')
                    ->whereIn('planilla_turno_user.local_user_id', $idUsers)
                    ->where('planilla_turno_user.created_at', '>=', $firstDay)
                    ->where('planilla_turno_user.created_at', '<=', $lastDay )
                    ->join('local_user', 'planilla_turno_user.local_user_id', '=', 'local_user.id')
                    ->where('local_user.local_id', $local->id)
                    ->join('users', 'local_user.user_id', '=', 'users.id')
                    ->distinct('local_user.local_id')
                    ->get();
                //Cuento la cantidad de empaques que tomaron turnos en el mes
                $cantUserTakeTurn = count($infoUsers);
                //total a pgar
                $totalPagar = $cantUserTakeTurn * $local->precioMensual;

                //información extra
                $datos = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'precio' => number_format($totalPagar,0, '', '.'),
                );

                Mail::send('vendor.notifications.email-cobro-mensual-encargados', $datos, function($msj) use($emailsEncargados){
                    $msj->to($emailsEncargados)->subject('Cobro Mensual - Proyecto Nero');
                });


            }elseif($local->responsablePago == 'Empaques'){
                //Envio emails a los empaques premium, precioMensual > 0
                //obtengo los emails de los encargados del local  (Se envía a todos sin importar si ya pagó o no tomó turnos!, ojo

                $firstDayLastMonth = date('Y-m-d', mktime(0,0,0, date('m', strtotime(date('Y-m-d').' - 1 month')), 1, date('Y')));
                $lastDayLastMonth = date('Y-m-d', mktime(0,0,0, date('m', strtotime(date('Y-m-d').' - 1 month')) + 1, 0, date('Y')));

                //Quiero saber quién tomó turnos (incluyendo los desvinculados), y excluyendo a los que han pagados
                $empTurnTaken= Local_User::select('local_user.id as idUserLocal', 'users.email')
                    ->where('local_user.local_id', $local->id)
                    ->join('users', 'users.id', '=', 'local_user.user_id')
                    ->join('planilla_turno_user', 'planilla_turno_user.local_user_id', '=', 'local_user.id')
                    ->where('planilla_turno_user.created_at', '>=', $firstDayLastMonth)
                    ->where('planilla_turno_user.created_at', '<=', $lastDayLastMonth)
                    ->distinct('planilla_turno_user.local_user_id')
                    ->get();

                $arrayIds = $empTurnTaken->pluck('idUserLocal')->toArray();

                //Ids de Personas que pagaron el mes anterior, Pluck->toarray devuelve así:     array:1 [▼ 0 => 52 ]
                $userPagaron = Pago::select('local_user_id')
                    ->where('estado', 'Aceptado')
                    ->where('paga', 'Empaque')
                    ->where('pagoDesde', '>=', $firstDayLastMonth)
                    ->where('pagoHasta', '<=', $lastDayLastMonth)
                    ->whereIn('local_user_id', $arrayIds)
                    ->pluck('local_user_id')
                    ->toArray();

                //Saco a los empaques que pagaron el mes
                $newEmpaques = $empTurnTaken->whereNotIn('idUserLocal', $userPagaron);

                //Convierto el Collection en un array SIN CLAVE ej: ['x@mail.com','y@gmail.com']
                $arrayEmails = $newEmpaques->pluck('email')->toArray();

                //información extra
                $datos = array(
                    'local' => $local->nombre,
                    'cadena' => $local->Cadena->nombre,
                    'precio' => number_format($local->precioMensual,0, '', '.'),
                );

                Mail::send('vendor.notifications.email-cobro-mensual-empaques', $datos, function($msj) use($arrayEmails){
                    $msj->to($arrayEmails)->subject('Cobro Mensual - Proyecto Nero');
                });
            }

        }


    }
}
