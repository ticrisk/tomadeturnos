<?php

use App\User;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'rut'                =>  '14683901-0',
            'email'                =>  'ssoriano@ticrisk.com',
            'nombre'                =>  'Santiago',
            'apellido'             =>  'Soriano',
            'estado'          =>  'Confirmado',
            'avatar'          =>  'avatar.jpg',
            'rol'          =>  'Admin',
            'ultimaConexion'   =>  '2016-08-14 14:00:00',
            'password'               =>  bcrypt('123456'),

            ]);
  
    }
}