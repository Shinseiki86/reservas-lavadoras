<?php

namespace LAVA\Models;

use Carbon\Carbon;
use LAVA\Models\ModelWithSoftDeletes;

class Reserva extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'RESERVAS';
	protected $primaryKey = 'RESE_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'RESE_FECHACREADO';
	const UPDATED_AT = 'RESE_FECHAMODIFICADO';
	const DELETED_AT = 'RESE_FECHAELIMINADO';
	protected $dates = ['RESE_FECHACREADO', 'RESE_FECHAMODIFICADO', 'RESE_FECHAELIMINADO'];


	protected $appends = ['fecha_alerta'];

	protected $fillable = [
        "RESE_TITULO",
        "RESE_FECHAINI",
        "RESE_HORAS",
        "LAVA_ID",
        "ESRE_ID",
        "RESE_ACEPTADA",
        "RESE_ACTIVADA",
	];


	public static function rules($id = 0){
		return [
			//'RESE_DESCRIPCION' => 'required|max:300|'.static::unique($id,'RESE_DESCRIPCION'),
			'RESE_FECHAINI' => ['numeric'],
			'RESE_CAPACIDAD' => ['numeric'],
			'RESE_OBSERVACIONES' => ['max:300'],
		];
	}

	public function estado()
	{
		$foreingKey = 'ESRE_ID';
		return $this->belongsTo(EstadoReserva::class, $foreingKey);
	}

	/*
	 * Relación users-LAVADORAS (muchos a muchos). 
	 */
	public function usuarios()
	{
		$foreingKey = 'RESE_ID';
		$otherKey   = 'USER_ID';
		return $this->belongsToMany(User::class, 'USUARIOS_EMPLEADORES', $foreingKey,  $otherKey);
	}

	/**
	 * Retorna el total de respuestas que han realizado a la encuesta.
	 *
	 * @param  void
	 * @return integer
	 */
	public function getFechaAlertaAttribute()
	{
		return Carbon::parse($this->RESE_FECHAINI)->subMinutes(15)->format('Y-m-d H:i:s');

	}

}
