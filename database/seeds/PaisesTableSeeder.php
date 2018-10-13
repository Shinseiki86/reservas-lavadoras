<?php

use Illuminate\Database\Seeder;
use LAVA\Models\Pais;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create([
            'PAIS_CODIGO'       => 57,
            'PAIS_NOMBRE'  =>  'COLOMBIA',
        ]);
    }
}