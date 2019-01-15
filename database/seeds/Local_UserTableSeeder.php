<?php

use App\Local_User;
use Illuminate\Database\Seeder;


class Local_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local_User::create([
            'cuposToma' => '4',
            'cuposPreToma' => '0',
            'estado' => 'Activo',
            'rol' => 'Encargado',
            'local_id' => '1',
            'user_id' => '1'
            ]);

    }
}