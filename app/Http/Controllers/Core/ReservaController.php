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
		$this->middleware('auth', [ 'except' => 'getReservas' ]);
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
		$data = []; //declaramos un array principal que va contener los datos
		
		//Se obtienen los registros de la base de datos
		$reservas = Reserva::join('LAVADORAS', 'LAVADORAS.LAVA_ID', '=', 'RESERVAS.LAVA_ID')
				->join('ESTADOSRESERVA', 'ESTADOSRESERVA.ESRE_ID', '=', 'RESERVAS.ESRE_ID')
				//->where('RESERVAS.LAVA_ID', $LAVA_ID)
				->select([
					'RESE_ID',
					'RESE_TITULO',
					'RESE_FECHAINI',
					'ESRE_COLOR',
					'RESERVAS.LAVA_ID',
					'LAVA_DESCRIPCION',
					'ESRE_NOMBRE',
					'RESE_CREADOPOR',
				])
				->get();
		//Con los datos obtenidos, se construye el JSON que será recibido por la vista en el Calendar.
		foreach ($reservas as $key => $res) {
			$data[] = [
				'title'=>str_replace('LAVADORA ', 'L', $res->RESE_TITULO.' ('.$res->RESE_CREADOPOR.')'), 
				'start'=>$res->RESE_FECHAINI,
				'end'=>Carbon::parse($res->RESE_FECHAINI)->addHour()->toDateTimeString(),
				'backgroundColor'=>$res->ESRE_COLOR,
				'RESE_ID'=>$res->RESE_ID,
				'LAVA_ID'=>$res->LAVA_ID,
				'LAVA_DESCRIPCION'=>$res->LAVA_DESCRIPCION,
				'ESRE_NOMBRE' => $res->ESRE_NOMBRE,
				'RESE_ID' => $res->RESE_ID,
				'RESE_CREADOPOR' => $res->RESE_CREADOPOR,
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
			$res = Reserva::create(
				array_only($rawReserva, [
					'RESE_TITULO',
					'RESE_FECHAINI',
					'RESE_HORAS',
					//'RESE_FECHAFIN',
					'LAVA_ID',
				]) + [
					'ESRE_ID' => EstadoReserva::PENDIENTE,
				]
			);
			//Se adiciona el ID al arreglo de reservas
			array_push($arrRESE_ID, $res->RESE_ID);
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



	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function getReservas($username)
	{
		//$user = User::where('username', $username)->get();

		//Se obtienen los registros de la base de datos
		$reservas = Reserva::join('LAVADORAS', 'LAVADORAS.LAVA_ID', '=', 'RESERVAS.LAVA_ID')
				->join('ESTADOSRESERVA', 'ESTADOSRESERVA.ESRE_ID', '=', 'RESERVAS.ESRE_ID')
				->where('RESE_CREADOPOR', $username)
				->select([
					'RESE_ID',
					'RESE_TITULO',
					'RESE_FECHAINI',
					'RESE_HORAS',
					'ESRE_COLOR',
					'RESERVAS.LAVA_ID',
					'LAVA_DESCRIPCION',
					'RESERVAS.ESRE_ID',
					'ESRE_NOMBRE',
				])->get();

		return $reservas->toJson();
	}

	
}
