@extends('layouts.menu')
@section('title', '/ Dashboard')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Dashboard
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			
		</div>
	</div>
@endsection

@section('section')

	@include('widgets.charts.panelchart', ['idCanvas' => 'chart1', 'title' => 'Contratos x Empleador' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart3', 'title' => 'Retiros x Mes' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart2', 'title' => 'Ingresos x Mes' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart4', 'title' => 'Personal Sin Clasificación' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart5', 'title' => 'Indicador de Rotación - Mes Anterior %' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart6', 'title' => 'Casos Médicos x Empleador' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart7', 'title' => 'Accidentes Severos del Mes' ])
	{{-- @include('widgets.charts.panelchart', ['idCanvas' => 'chart4', 'title' => 'Tickets x Estado' ]) --}}
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart8', 'title' => 'Tickets abiertos x Empresa' ])

@endsection

@push('scripts')
	{!! Html::script('assets/scripts/chart.js/Chart.min.js') !!}
	{!! Html::script('assets/scripts/momentjs/moment-with-locales.min.js') !!}
	{!! Html::script('assets/scripts/chart.js/dashboard.js') !!}
	<script type="text/javascript">
		$(function () {
			newChart(
				'gestion-humana/getContratosEmpleador',
				'Personal Activo',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart1',
				'bar'
			);
			newChart(
				'gestion-humana/getIngresosMesEmpleador',
				'Ingresos del Mes',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart2',
				'bar'
			);
			newChart(
				'gestion-humana/getRetiradosMesEmpleador',
				'Retiros del Mes',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart3',
				'bar'
			);
			newChart(
				'gestion-humana/getContratosSinClasificacion',
				'Personal sin Clasificación',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart4',
				'bar'
			);
			{{-- 
			newChart(
				'cnfg-tickets/getTicketsPorEstado',
				'Tickets Por Estado',
				'ESTI_DESCRIPCION',
				'count',
				'chart4',
				'bar'
			);
			--}}
			newChart(
				'gestion-humana/getRotacionTotal',
				'Indicador de Rotación - Mes Anterior %',
				'EMPRESA',
				'indicador',
				'chart5',
				'bar'
			);
			newChart(
				'gestion-humana/getContratosCasosMedicos',
				'Casos Médicos',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart6',
				'bar'
			);
			newChart(
				'gestion-humana/getContratosCasosMedicosSeveridad',
				'Accidentes Severos',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart7',
				'bar'
			);
			newChart(
				'cnfg-tickets/getTicketsAbiertosPorEmpresa',
				'Tickets Abiertos Por Empresa',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart8',
				'bar'
			);
			/*
			newChart(
				'gestion-humana/getContratosParticipacion',
				'Participación',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart1',
				'bar'
			);
			*/
			$('.typeChart').removeClass('disabled');
		});
	</script>
@endpush