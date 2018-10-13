<?php
namespace LAVA\Http\Controllers\Reportes;
use LAVA\Http\Controllers\Controller;

use \Carbon\Carbon;

use LAVA\Models\Audit;

class RptAuditoriasController extends ReporteController
{

	public function __construct()
	{
		parent::__construct();
	}


	private function getQuery()
	{

		$query = Audit::join('users', 'users.id', '=', 'audits.user_id')
			->select([
				'audits.id as ID',
				'users.username as USER',
				'audits.event as EVENT',
				'audits.auditable_id as AUDITABLE_ID',
				'audits.auditable_type as AUDITABLE_TYPE',
				'audits.old_values as OLD_VALUES',
				'audits.new_values as NEW_VALUES',
				'audits.url as URL',
				'audits.ip_address as IP_ADDRESS',
				'audits.user_agent as USER_AGENT',
				'audits.created_at as CREATED_AT',
				'audits.updated_at as UPDATED_AT',
			]);

		return $query;
	}

	/**
	 * 
	 *
	 * @return Json
	 */
	public function logsAuditoria()
	{
		$query = $this->getQuery();

		if(isset($this->data['fchaDesde']))
			$query->whereDate('audits.created_at', '>=', Carbon::parse($this->data['fchaDesde']));
		if(isset($this->data['fchaHasta']))
			$query->whereDate('audits.created_at', '<=', Carbon::parse($this->data['fchaHasta']));

		return $this->buildJson($query, $columnChart='EVENT');
	}


}