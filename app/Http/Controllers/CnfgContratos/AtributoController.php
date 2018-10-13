<?php

namespace LAVA\Http\Controllers\CnfgContratos;

use LAVA\Http\Controllers\Controller;

use LAVA\Models\Atributo;

class AtributoController extends Controller
{
	protected $route = 'cnfg-contratos.atributos';
	protected $class = Atributo::class;

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
		$atributos = Atributo::all();
		//Se carga la vista y se pasan los registros
		return view($this->route.'.index', compact('atributos'));
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
	 * @param  int  $ATRI_ID
	 * @return Response
	 */
	public function edit($ATRI_ID)
	{
		// Se obtiene el registro
		$atributo = Atributo::findOrFail($ATRI_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('atributo'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ATRI_ID
	 * @return Response
	 */
	public function update($ATRI_ID)
	{
		parent::updateModel($ATRI_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $ATRI_ID
	 * @return Response
	 */
	public function destroy($ATRI_ID)
	{
		parent::destroyModel($ATRI_ID);
	}
	
}
