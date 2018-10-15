<?php

use Illuminate\Database\Seeder;
use LAVA\Models\EstadoReserva;

class EstadoReservaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('---Seeder EstadoReserva');

        EstadoReserva::create([
            'ESRE_NOMBRE' => 'PENDIENTE',
            'ESRE_COLOR' => 'rgb(255, 255, 0)', //Yellow
        ]);
        EstadoReserva::create([
            'ESRE_NOMBRE' => 'APROBADO',
            'ESRE_COLOR' => 'rgb(0, 255, 0)',   //Lime
        ]);
        EstadoReserva::create([
            'ESRE_NOMBRE' => 'ANULADO',
            'ESRE_COLOR' => 'rgb(255, 0, 0)',   //Red
        ]);
        EstadoReserva::create([
            'ESRE_NOMBRE' => 'FINALIZADO',
            'ESRE_COLOR' => 'rgb(204, 204, 204)',   //Gray 80%
        ]);
    }
}
