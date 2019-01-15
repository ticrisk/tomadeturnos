<?php

use App\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create(['nombre' => 'Metropolitana']);
        Region::create(['nombre' => 'Arica y Parinacota']);
        Region::create(['nombre' => 'Tarapacá']);
        Region::create(['nombre' => 'Antofagasta']);
        Region::create(['nombre' => 'Atacama']);
        Region::create(['nombre' => 'Coquimbo']);
        Region::create(['nombre' => 'Valparaíso']);
        Region::create(['nombre' => 'OHiggins']);
        Region::create(['nombre' => 'Maule']);
        Region::create(['nombre' => 'Bio-Bío']);
        Region::create(['nombre' => 'La Araucanía']);
        Region::create(['nombre' => 'Los Ríos']);
        Region::create(['nombre' => 'Los Lagos']);
        Region::create(['nombre' => 'Aysén']);
        Region::create(['nombre' => 'Magallanes']);
    }
}
