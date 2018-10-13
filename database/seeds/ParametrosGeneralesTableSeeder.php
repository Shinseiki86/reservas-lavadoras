<?php

use Illuminate\Database\Seeder;
use LAVA\Models\ParametroGeneral;

class ParametrosGeneralesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info('---Seeder ParametrosGenerales');

       	$parametrogeneral = new ParametroGeneral;
	    $parametrogeneral->PAGE_DESCRIPCION = 'DIAS_NOTIFICACION_TEMPORALIDAD';
	    $parametrogeneral->PAGE_VALOR = '300';
	    $parametrogeneral->PAGE_OBSERVACIONES = 'NUMERO DE DÍAS QUE SE ESPECIFICAN PARA TOMARLOS COMO BASE PARA LA GENERACIÓN DE REPORTE DE PROXIMOS A TEMPORALIDAD';
	    $parametrogeneral->PAGE_CREADOPOR = 'SYSTEM';
	    $parametrogeneral->save();

        $parametrogeneral = new ParametroGeneral;
        $parametrogeneral->PAGE_DESCRIPCION = 'FLAG_VALID_PLANTAS';
        $parametrogeneral->PAGE_VALOR = 'SI';
        $parametrogeneral->PAGE_OBSERVACIONES = 'BANDERA QUE DETERMINA SI SE REALIZA LA VALIDACIÓN DE PLANTAS DE PERSONAL PARA LA CONTRATACIÓN';
        $parametrogeneral->PAGE_CREADOPOR = 'SYSTEM';
        $parametrogeneral->save();
    }
}
