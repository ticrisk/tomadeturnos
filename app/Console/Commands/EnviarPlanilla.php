<?php

namespace App\Console\Commands;

use App\Local;
use Illuminate\Console\Command;

class EnviarPlanilla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:jefe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crontab, Enviar planilla al jefe una vez por semana';

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
        $locales = Local::where('cuenta', 'Premium')->where('estado', 'Activo')->where('emailJefe', '!=', null)->get();
    }
}
