<?php

use App\Cadena;
use Illuminate\Database\Seeder;


class CadenaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cadena::create(['nombre' => 'Santa Isabel']);
        Cadena::create(['nombre' => 'Lider Express']);
        Cadena::create(['nombre' => 'Unimarc']);
        Cadena::create(['nombre' => 'Mayorista 10']);


    }
}