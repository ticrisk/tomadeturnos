<?php

use App\Local;
use Illuminate\Database\Seeder;


class LocalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local::create([
            'nombre'                =>  'Chicureo',
            'cuenta'                =>  'Free',
            'estado'                =>  'Activo',
            'direccion'             =>  'Av. Chicureo 223',
            //codigo ->null
            'intercambiar'          =>  'No',
            'regalarLocal'          =>  'Si',
            'regalarOrganizacion'   =>  'No',
            'preToma'               =>  'No',
            'repechajeLocal'        =>  'Si',
            'repechajeOrganizacion' =>  'No',
            'cadena_id'             =>  '1',
            'organizacion_id'       =>  '1'
            ]);
  
    }
}