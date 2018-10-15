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

	@include('widgets.charts.panelchart', ['idCanvas' => 'chart1', 'title' => 'Lavadoras x horas de uso' ])

@endsection

@push('scripts')
	{!! Html::script('assets/scripts/chart.js/Chart.min.js') !!}
	{!! Html::script('assets/scripts/momentjs/moment-with-locales.min.js') !!}
	{!! Html::script('assets/scripts/chart.js/dashboard.js') !!}
	<script type="text/javascript">
		$(function () {
			newChart(
				'core/getLavadorasHorasUso',
				'Lavadoras por horas de uso',
				'LAVA_DESCRIPCION',
				'count',
				'chart1',
				'bar'
			);
			$('.typeChart').removeClass('disabled');
		});
	</script>
@endpush