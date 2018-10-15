<?php

namespace LAVA\Models;

use LAVA\Models\ModelWithSoftDeletes;

class Lavadora extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'LAVADORAS';
	protected $primaryKey = 'LAVA_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'LAVA_FECHACREADO';
	const UPDATED_AT = 'LAVA_FECHAMODIFICADO';
	const DELETED_AT = 'LAVA_FECHAELIMINADO';
	protected $dates = ['LAVA_FECHACREADO', 'LAVA_FECHAMODIFICADO', 'LAVA_FECHAELIMINADO'];

	protected $fillable = [
		'LAVA_DESCRIPCION',
		'LAVA_CAPACIDAD',
		'LAVA_OBSERVACIONES',
	];

	public static function rules($id = 0){
		return [
			'LAVA_DESCRIPCION' => 'required|max:300|'.static::unique($id,'LAVA_DESCRIPCION'),
			'LAVA_CAPACIDAD' => ['numeric'],
			'LAVA_OBSERVACIONES' => ['max:300'],
		];
	}


	/*
	 * Relación users-LAVADORAS (muchos a muchos). 
	 */
	public function usuarios()
	{
		$foreingKey = 'LAVA_ID';
		$otherKey   = 'USER_ID';
		return $this->belongsToMany(User::class, 'USUARIOS_EMPLEADORES', $foreingKey,  $otherKey);
	}

}
