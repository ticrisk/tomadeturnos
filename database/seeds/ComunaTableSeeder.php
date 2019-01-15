<?php

use App\Comuna;
use Illuminate\Database\Seeder;

class ComunaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comuna::create(['nombre' => 'Colina', 'region_id' => '1']);
        Comuna::create(['nombre' => 'Cerrillos', 'region_id' => '1']);
        Comuna::create(['nombre' => 'La Florida', 'region_id' => '1']);
        Comuna::create(['nombre' => 'Las Condes', 'region_id' => '1']);
        Comuna::create(['nombre' => 'Maipú', 'region_id' => '1']);
        Comuna::create(['nombre' => 'Taranganica', 'region_id' => '2']);
    }
}
