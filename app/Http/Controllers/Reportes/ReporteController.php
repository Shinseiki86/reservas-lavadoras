<?php
namespace LAVA\Http\Controllers\Reportes;
use LAVA\Http\Controllers\Controller;
use Illuminate\Http\Request;

use LAVA\Models\Prospecto;
use LAVA\Models\User;

class ReporteController extends Controller
{
	protected $data = null;

	private $reportesadm = [
		/*Bloque para reportes de Administrador*/
		//==============================================================================================
		['id'=>'LogsAuditorias', 'title'=>'900 - LOGS DE AUDITORÍA'],
		//==============================================================================================
	];

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:reportes');
		//Datos recibidos desde la vista.
		$this->data = parent::getRequest();
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$arrReportes = $this->getReportArray(\Auth::user()->id);
		return view('reportes.index', compact('arrReportes'));
	}

	public function viewForm(Request $request)
	{
		$form = $request->input('form');

		return response()->json(view('reportes.formRep'.$form)->render());
	}


	/**
	 * 
	 *
	 * @return Response
	 */
	protected function buildJson($query, $columnChart = null)
	{
		$colletion = $query->get();
		$keys = $data = [];

		if(!$colletion->isEmpty()){
			$keys = array_keys($colletion->first()->toArray());
			$data = array_map(function ($arr){
					return array_flatten($arr);
				}, $colletion->toArray());
		}
		return response()->json(compact('keys', 'data', 'columnChart'));
	}

	public function getReportArray($id){
		$reports = null;
		$user = User::findOrFail($id);

		if($user->hasRole(['admin', 'gesthum', 'ejecutivo'])){
            //si es un administrador se listan todos los reportes del sistema
            $reports = array_merge($this->reportesgh, $this->reportescompartidos, $this->reportesop, $this->reportesadm);
        }elseif($user->hasRole(['superoper', 'cooroper'])) {
        	 //si es un usuario diferente de administrador se listan algunos de los reportes del sistema
            $reports = array_merge($this->reportesop, $this->reportescompartidos);
        }elseif($user->hasRole(['sst'])) {
        	 //si es un usuario de seguridad y salud en el trabajo solo muestra los reportes de su rol
            $reports = array_merge($this->reportessst, $this->reportescompartidos);
        }else{
        	$reports = array_merge($this->reportesop, $this->reportescompartidos);;
        }
        return $reports;
	}

}
