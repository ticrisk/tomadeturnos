<?php

use App\Universidad;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UniversidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Universidad::create(['nombre' => 'San Sebastian']);
        Universidad::create(['nombre' => 'Inacap']);
        Universidad::create(['nombre' => 'DuocUC']);
        Universidad::create(['nombre' => 'Las Americas']);
        Universidad::create(['nombre' => 'Usach']);
        Universidad::create(['nombre' => 'Catolica']);
        Universidad::create(['nombre' => 'Los Leones']);

    }
}