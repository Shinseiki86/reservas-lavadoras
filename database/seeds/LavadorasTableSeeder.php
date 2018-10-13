<?php

use Illuminate\Database\Seeder;
use LAVA\Models\Lavadora;

class LavadorasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('---Seeder Lavadoras');

        Lavadora::create([
            'LAVA_DESCRIPCION' => 'LAVADORA 1',
            'LAVA_CAPACIDAD' => 15,
            'LAVA_OBSERVACIONES' => '',
       ]);
        Lavadora::create([
            'LAVA_DESCRIPCION' => 'LAVADORA 2',
            'LAVA_CAPACIDAD' => 20,
            'LAVA_OBSERVACIONES' => '',
       ]);
        Lavadora::create([
            'LAVA_DESCRIPCION' => 'LAVADORA 3',
            'LAVA_CAPACIDAD' => 15,
            'LAVA_OBSERVACIONES' => '',
       ]);
    }
}
