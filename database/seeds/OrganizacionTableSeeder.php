<?php

use App\Organizacion;
use Illuminate\Database\Seeder;


class OrganizacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organizacion::create(['nombre' => 'Los Pumas']);
        Organizacion::create(['nombre' => 'Las Panteras']);
        Organizacion::create(['nombre' => 'UniBlock']);
        Organizacion::create(['nombre' => 'Los Pulentos']);


    }
}