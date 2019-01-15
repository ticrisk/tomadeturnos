<?php

use App\Carrera;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CarreraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::create(['nombre' => 'Enfermería']);
        Carrera::create(['nombre' => 'Informática']);
        Carrera::create(['nombre' => 'Mecánica']);
        Carrera::create(['nombre' => 'Contador']);
        Carrera::create(['nombre' => 'Nutricionista']);
        Carrera::create(['nombre' => 'Psicología']);
        Carrera::create(['nombre' => 'Veterinario']);

    }
}