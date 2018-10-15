<?php

namespace LAVA\Http\Controllers\Core;

use Illuminate\Http\Request;
use LAVA\Http\Controllers\Controller;
use Carbon\Carbon;

use LAVA\Models\Reserva;
use LAVA\Models\EstadoReserva;
use LAVA\Models\Lavadora;

class ReservaController extends Controller
{
	protected $route = 'core.reservas';
	protected $class = Reserva::class;

	public function __construct()
	{
		$this->middleware('auth');
		//parent::__construct();
	}
	
	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$arrLavadoras = model_to_array(Lavadora::class, 'LAVA_DESCRIPCION');
		return view($this->route.'.index', compact('arrLavadoras'));
	}


	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function cargaEventos()
	{
		//$sala = $request->input('sala');
		
		$data = []; //declaramos un array principal que va contener los datos

		//$reservas = \reservas\Sala::findOrFail($sala)->reservas;
		$reservas = Reserva::join('LAVADORAS', 'LAVADORAS.LAVA_ID', '=', 'RESERVAS.LAVA_ID')
						->join('ESTADOSRESERVA', 'ESTADOSRESERVA.ESRE_ID', '=', 'RESERVAS.ESRE_ID')
						//->where('RESERVAS.LAVA_ID', $LAVA_ID)
						->select([
					        "RESE_TITULO",
					        "RESE_FECHAINI",
					        "ESRE_COLOR",
					        "LAVA_DESCRIPCION",
					        "ESRE_NOMBRE",
					        "RESE_CREADOPOR",
						])
						->get();

		foreach ($reservas as $key => $reserva) {
			$data[] = [
				"title"=>str_replace('LAVADORA ', 'L', $reserva->RESE_TITULO.'('.$reserva->RESE_CREADOPOR.')'), //obligatoriamente "title", "start" y "url" son campos requeridos
				"start"=>$reserva->RESE_FECHAINI, //por el plugin asi que asignamos a cada uno el valor correspondiente
				"end"=>Carbon::parse($reserva->RESE_FECHAINI)->addHour()->toDateTimeString(),
				//"allDay"=>$reserva->ALLDAY,
				"backgroundColor"=>$reserva->ESRE_COLOR,
				//"borderColor"=>$borde[$i],
				"RESE_ID"=>$reserva->RESE_ID,
				"LAVA_DESCRIPCION"=>$reserva->LAVA_DESCRIPCION,
				"ESRE_NOMBRE" => $reserva->ESRE_NOMBRE,
				"RESE_ID" => $reserva->RESE_ID,
				"RESE_CREADOPOR" => $reserva->RESE_CREADOPOR,
			];
		}

	   return json_encode($data);
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
	 * @param  int  $RESE_ID
	 * @return Response
	 */
	public function edit($RESE_ID)
	{
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $RESE_ID
	 * @return Response
	 */
	public function update($RESE_ID)
	{
		parent::updateModel($RESE_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $RESE_ID
	 * @return Response
	 */
	public function destroy($RESE_ID)
	{
		parent::destroyModel($RESE_ID);
	}


	/* Crea las reservas recibidas por ajax y su respectiva autorización.
	 * 
	*/
	public function guardarReservas(Request $request)
	{

		$fechaactual = Carbon::now();

		$rawReservasInput = $request->get('reservas');

		//Arreglo para almacenar los id´s de las reservas creadas
		$arrRESE_ID = [];

		if(!isset($rawReservasInput) OR !is_array($rawReservasInput) OR empty($rawReservasInput)){
			return response()->json([
				'ERROR' => 'Datos incompletos.',
				'reservas' => json_encode($rawReservasInput)
			], 400); //400 Bad Request: La solicitud contiene sintaxis errónea y no debería repetirse
		}

		foreach ($rawReservasInput as $rawReserva) {

			//El color no se guarda en la BD sino que se calcula dependiento el estado de la reserva
			/*if($ROLE_ID == \reservas\Rol::ADMIN)
				$color = Reserva::COLOR_APROBADO;
			else
				$color = Reserva::COLOR_PENDIENTE;*/

			//Crear reserva:
			$reserva = Reserva::create(
				array_only($rawReserva, [
					'RESE_TITULO',
					'RESE_FECHAINI',
					'RESE_HORA',
					//'RESE_FECHAFIN',
					'LAVA_ID',
				]) + [
					'ESRE_ID' => EstadoReserva::PENDIENTE,
				]
			);
			//Se adiciona el ID al arreglo de reservas
			array_push($arrRESE_ID, $reserva->RESE_ID);
		}

		//Si se crearon reservas...
		if(count($arrRESE_ID) == 0){
			return response()->json([
				'ERROR' => 'No se crearon reservas.',
				'request' => json_encode($request->all())
			]);
		}

		return $arrRESE_ID;
	}
	
}
