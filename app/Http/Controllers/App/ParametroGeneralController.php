<?php

namespace LAVA\Http\Controllers\App;

use LAVA\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;
use LAVA\Http\Controllers\Controller;

use LAVA\Models\ParametroGeneral;

class ParametroGeneralController extends Controller
{
	protected $route = 'app.parametrosgenerales';
	protected $class = ParametroGeneral::class;

	public function __construct()
	{
		//parent::__construct();
		$this->middleware('auth');
		$this->middleware('permission:app-parametrosgenerales');
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Se obtienen todos los registros.
		$parametrosgenerales = ParametroGeneral::all();
		//Se carga la vista y se pasan los registros
		return view($this->route.'.index', compact('parametrosgenerales'));
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
	 * @param  int  $PAGE_ID
	 * @return Response
	 */
	public function edit($PAGE_ID)
	{
		// Se obtiene el registro
		$parametrogeneral = ParametroGeneral::findOrFail($PAGE_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('parametrogeneral'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $PAGE_ID
	 * @return Response
	 */
	public function update($PAGE_ID)
	{
		parent::updateModel($PAGE_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $PAGE_ID
	 * @return Response
	 */
	public function destroy($PAGE_ID)
	{
		parent::destroyModel($PAGE_ID);
	}
	
}
