<?php

namespace App\Console;

use App\Console\Commands\BloqueoDeudores;
use App\Console\Commands\EmailCobro;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        EmailCobro::class,
        BloqueoDeudores::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Enviar email de cobranza el primero de cada mes a las 12:00
        $schedule->command('email:cobro')->monthlyOn(1, '12:00');
        //cambiar de estado a "deudores" los empaques que no registran pagos
        $schedule->command('email:bloqueo')->monthlyOn(8, '08:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
