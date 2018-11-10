<?php

namespace LAVA\Http\Controllers\Core;

use Illuminate\Http\Request;
use LAVA\Http\Controllers\Controller;
use Carbon\Carbon;

use LAVA\Models\User;
use LAVA\Models\Reserva;
use LAVA\Models\EstadoReserva;
use LAVA\Models\Lavadora;

class ReservaController extends Controller
{
	protected $route = 'core.reservas';
	protected $class = Reserva::class;

	public function __construct()
	{
		$this->middleware('auth', [ 'except' => ['getReservas','delete', 'activar','confirmar','getLavadorasActivas','finalizar', ] ]);
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
				->whereIn('RESERVAS.ESRE_ID', [EstadoReserva::PENDIENTE, EstadoReserva::APROBADA, EstadoReserva::ACTIVADA])
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
		//parent::destroyModel($RESE_ID);

		$reserva = Reserva::find($RESE_ID);
		if(isset($reserva)){
			$reserva->delete();
			flash_alert( 'Reserva '.$RESE_ID.' eliminada exitosamente.', 'success' );
		}

		return redirect()->route($this->route.'.index')->send();
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
		//Se obtienen los registros de la base de datos
		$reservas = Reserva::join('LAVADORAS', 'LAVADORAS.LAVA_ID', '=', 'RESERVAS.LAVA_ID')
				->join('ESTADOSRESERVA', 'ESTADOSRESERVA.ESRE_ID', '=', 'RESERVAS.ESRE_ID')
				->where('RESE_CREADOPOR', $username)
				->whereIn('RESERVAS.ESRE_ID', [EstadoReserva::PENDIENTE, EstadoReserva::APROBADA, EstadoReserva::ACTIVADA])
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
					'RESE_ACEPTADA',
					'RESE_ACTIVADA',
				])->get();

		if(isset($reservas)){
			return json_encode([
				'data'   =>$reservas,
				'status' =>true,
				'mensaje'=>'OK'
			]);
		} else {
			return json_encode([
				'data'   =>[],
				'status' =>false,
				'mensaje'=>'El usuario no tiene reservas.'
			]);
		}
	}


	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function delete($RESE_ID)
	{
		$reserva = Reserva::find($RESE_ID);

		if(isset($reserva)){
			$reserva->delete();
			return json_encode([
				'data'   =>$reserva,
				'status' =>true,
				'mensaje'=>'Reserva eliminada'
			]);
		} else {
			return json_encode([
				'data'   =>[],
				'status' =>false,
				'mensaje'=>'Reserva no existe'
			]);
		}
	}


	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function confirmar($RESE_ID)
	{
		$reserva = Reserva::find($RESE_ID);

		if(isset($reserva)){
			$reserva->update(['RESE_ACEPTADA'=>true, 'ESRE_ID'=>EstadoReserva::APROBADA]);
			return json_encode([
				'data'   =>$reserva,
				'status' =>true,
				'mensaje'=>'Reserva confirmada'
			]);
		} else {
			return json_encode([
				'data'   =>[],
				'status' =>false,
				'mensaje'=>'Reserva no existe'
			]);
		}
	}


	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function activar($RESE_ID)
	{
		$reserva = Reserva::find($RESE_ID);

		if(isset($reserva)){
			$reserva->update(['RESE_ACTIVADA'=>true, 'ESRE_ID'=>EstadoReserva::ACTIVADA]);
			return json_encode([
				'data'   =>$reserva,
				'status' =>true,
				'mensaje'=>'Reserva activada'
			]);
		} else {
			return json_encode([
				'data'   =>[],
				'status' =>false,
				'mensaje'=>'Reserva no existe'
			]);
		}
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function finalizar($RESE_ID)
	{
		$reserva = Reserva::find($RESE_ID);

		if(isset($reserva)){
			$reserva->update(['RESE_ACTIVADA'=>false, 'ESRE_ID'=>EstadoReserva::FINALIZADA]);
			$user = User::where('username', $reserva->RESE_CREADOPOR)->first();

			$now = Carbon::now();
            $fechaini = Carbon::parse($reserva->RESE_FECHAINI)->second(0);
            //$fechafin = $fechaini->copy()->addHours($reserva->RESE_HORAS);

            $diff = $fechaini->diffInHours($now);
            $precio = 2000;
            $costo = $precio * ($diff+1);
            $user->saldo -= $costo;
            $user->save();
			return json_encode([
				'data'   =>['saldo'=>$user->saldo, 'costo'=>$costo],
				'status' =>true,
				'mensaje'=>'Reserva finalizada'
			]);
		} else {
			return json_encode([
				'data'   =>[],
				'status' =>false,
				'mensaje'=>'Reserva no existe'
			]);
		}
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function getLavadorasActivas()
	{
		$fechaactual = Carbon::now();
		$reservas = Reserva::where('RESE_ACTIVADA', true)
					->where('ESRE_ID', EstadoReserva::ACTIVADA)
					->select('LAVA_ID')
					//->whereBetween('RESE_FECHAINI', [$fechaactual->addSeconds(-5), $fechaactual->addSeconds(5)])
					->get()->pluck('LAVA_ID')->unique()->sort()->values()->all();

		$lavadoras = [
			1 => in_array(1, $reservas)?1:0,
			2 => in_array(2, $reservas)?1:0,
			3 => in_array(3, $reservas)?1:0,
		];
		
		if(isset($reservas)){
			return json_encode([
				'data'   =>$lavadoras,
				'status' =>true,
				'mensaje'=>'OK'
			]);
		} else {
			return json_encode([
				'data'   =>[],
				'status' =>false,
				'mensaje'=>'No hay reservas activas'
			]);
		}
	}

	
}
