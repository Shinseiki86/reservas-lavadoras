<?php

use Illuminate\Database\Seeder;
use LAVA\Models\Departamento;

class DepartamentosTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$dptos = [
			['DEPA_CODIGO' => 5, 'DEPA_NOMBRE' => 'ANTIOQUIA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 8, 'DEPA_NOMBRE' => 'ATLANTICO', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 11, 'DEPA_NOMBRE' => 'BOGOTA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 13, 'DEPA_NOMBRE' => 'BOLIVAR', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 15, 'DEPA_NOMBRE' => 'BOYACA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 17, 'DEPA_NOMBRE' => 'CALDAS', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 18, 'DEPA_NOMBRE' => 'CAQUETA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 19, 'DEPA_NOMBRE' => 'CAUCA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 20, 'DEPA_NOMBRE' => 'CESAR', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 23, 'DEPA_NOMBRE' => 'CORDOBA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 25, 'DEPA_NOMBRE' => 'CUNDINAMARCA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 27, 'DEPA_NOMBRE' => 'CHOCO', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 41, 'DEPA_NOMBRE' => 'HUILA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 44, 'DEPA_NOMBRE' => 'LA GUAJIRA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 47, 'DEPA_NOMBRE' => 'MAGDALENA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 50, 'DEPA_NOMBRE' => 'META', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 52, 'DEPA_NOMBRE' => 'NARIÑO', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 54, 'DEPA_NOMBRE' => 'N. DE SANTANDER', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 63, 'DEPA_NOMBRE' => 'QUINDIO', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 66, 'DEPA_NOMBRE' => 'RISARALDA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 68, 'DEPA_NOMBRE' => 'SANTANDER', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 70, 'DEPA_NOMBRE' => 'SUCRE', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 73, 'DEPA_NOMBRE' => 'TOLIMA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 76, 'DEPA_NOMBRE' => 'VALLE DEL CAUCA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 81, 'DEPA_NOMBRE' => 'ARAUCA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 85, 'DEPA_NOMBRE' => 'CASANARE', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 86, 'DEPA_NOMBRE' => 'PUTUMAYO', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 88, 'DEPA_NOMBRE' => 'SAN ANDRES', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 91, 'DEPA_NOMBRE' => 'AMAZONAS', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 94, 'DEPA_NOMBRE' => 'GUAINIA', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 95, 'DEPA_NOMBRE' => 'GUAVIARE', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 97, 'DEPA_NOMBRE' => 'VAUPES', 'PAIS_ID' => 1],
			['DEPA_CODIGO' => 99, 'DEPA_NOMBRE' => 'VICHADA', 'PAIS_ID' => 1],
		];

		foreach ($dptos as $dpto) {
			Departamento::create($dpto);
		}
	}
}
