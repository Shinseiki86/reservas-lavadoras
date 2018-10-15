<?php

namespace LAVA\Models;

use LAVA\Models\ModelWithSoftDeletes;

class EstadoReserva extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'ESTADOSRESERVA';
	protected $primaryKey = 'ESRE_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ESRE_FECHACREADO';
	const UPDATED_AT = 'ESRE_FECHAMODIFICADO';
	const DELETED_AT = 'ESRE_FECHAELIMINADO';
	protected $dates = ['ESRE_FECHACREADO', 'ESRE_FECHAMODIFICADO', 'ESRE_FECHAELIMINADO'];

	protected $fillable = [
        'ESRE_NOMBRE',
        'ESRE_COLOR',
        'ESRE_OBSERVACIONES',
	];

	const PENDIENTE = 1;
	const APROBADA  = 2;
	const ANULADA   = 3;
	const FINALIZADA= 4;

	public static function rules($id = 0){
		return [
			'ESRE_NOMBRE' => 'required|max:50|'.static::unique($id,'ESRE_DESCRIPCION'),
			'ESRE_OBSERVACIONES' => ['max:300'],
		];
	}


	/*
	 * Relación users-LAVADORAS (muchos a muchos). 
	 */
	public function reservas()
	{
		$foreingKey = 'ESRE_ID';
		return $this->hasMany(Reserva::class, $foreingKey);
	}

}
