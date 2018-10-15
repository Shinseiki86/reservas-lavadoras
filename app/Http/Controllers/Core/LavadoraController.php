<?php

namespace LAVA\Http\Controllers\Core;

use LAVA\Http\Controllers\Controller;

use LAVA\Models\Lavadora;

class LavadoraController extends Controller
{
	protected $route = 'core.lavadoras';
	protected $class = Lavadora::class;

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Se obtienen todos los registros.
		$lavadoras = Lavadora::all();
		//Se carga la vista y se pasan los registros
		return view($this->route.'.index', compact('lavadoras'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create');
	}

	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		parent::storeModel();
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $LAVA_ID
	 * @return Response
	 */
	public function edit($LAVA_ID)
	{
		// Se obtiene el registro
		$lavadora = Lavadora::findOrFail($LAVA_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('lavadora'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $LAVA_ID
	 * @return Response
	 */
	public function update($LAVA_ID)
	{
		parent::updateModel($LAVA_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $LAVA_ID
	 * @return Response
	 */
	public function destroy($LAVA_ID)
	{
		parent::destroyModel($LAVA_ID);
	}
	
}
