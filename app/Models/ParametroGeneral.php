<?php

namespace LAVA\Models;

use LAVA\Models\ModelWithSoftDeletes;

class ParametroGeneral extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'PARAMETROSGENERALES';
	protected $primaryKey = 'PAGE_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PAGE_FECHACREADO';
	const UPDATED_AT = 'PAGE_FECHAMODIFICADO';
	const DELETED_AT = 'PAGE_FECHAELIMINADO';
	protected $dates = ['PAGE_FECHACREADO', 'PAGE_FECHAMODIFICADO', 'PAGE_FECHAELIMINADO'];

	protected $fillable = [
		'PAGE_DESCRIPCION',
		'PAGE_VALOR',
		'PAGE_OBSERVACIONES',
	];

	public static function rules($id = 0){
		return [
			'PAGE_DESCRIPCION' => 'required|max:100|'.static::unique($id,'PAGE_DESCRIPCION'),
			'PAGE_VALOR' => 'required',
			'PAGE_OBSERVACIONES' => 'max:300',
		];
	}


}
