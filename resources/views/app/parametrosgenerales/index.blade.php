@extends('layouts.menu')
@section('title', '/ Parametros Generales')
@include('widgets.datatable.datatable-export')


@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Parametros Generales
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('app.parametrosgenerales.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-4">Descripción</th>
				<th class="col-md-4">Valor</th>
				<th class="col-md-6">Observaciones</th>
				<th class="hidden-xs col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($parametrosgenerales as $parametrogeneral)
			<tr>
				<td>{{ $parametrogeneral -> PAGE_DESCRIPCION }}</td>
				<td>{{ $parametrogeneral -> PAGE_VALOR }}</td>
				<td>{{ $parametrogeneral -> PAGE_OBSERVACIONES }}</td>
				<td>{{ $parametrogeneral -> PAGE_CREADOPOR }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('app.parametrosgenerales.edit', [ 'PAGE_ID' => $parametrogeneral->PAGE_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fas fa-edit" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fas fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $parametrogeneral->PAGE_ID,
						'data-modelo'=> str_upperspace(class_basename($parametrogeneral)),
						'data-descripcion'=> $parametrogeneral->PAGE_DESCRIPCION,
						'data-action'=>'parametrosgenerales/'. $parametrogeneral->PAGE_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
@endsection