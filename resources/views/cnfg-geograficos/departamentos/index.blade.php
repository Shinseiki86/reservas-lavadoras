@extends('layouts.menu')
@section('title', '/ Departamentos')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Departamentos
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('cnfg-geograficos.departamentos.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Código</th>
				<th class="col-md-3">Nombre</th>
				<th class="col-md-3">País</th>
				<th class="col-md-1">Ciudades</th>
				<th class="hidden-xs col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getDepartamentos', 'columns'=>[
		'DEPA_CODIGO',
		'DEPA_NOMBRE',
		'PAIS_NOMBRE',
		'CIUDADES_COUNT',
		'DEPA_CREADOPOR',
	]])	
@endsection