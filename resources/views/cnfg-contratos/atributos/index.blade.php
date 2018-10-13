@extends('layouts.menu')
@section('title', '/ Atributos')
@include('widgets.datatable.datatable-export')


@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Atributos
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('cnfg-contratos.atributos.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fas fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-5">Descripción</th>
				<th class="col-md-5">Observaciones</th>
				<th class="hidden-xs col-md-2">Creado por</th>
				<th class="col-md-1"></th>
			</tr>
		</thead>

		<tbody>
			@foreach($atributos as $atributo)
			<tr>
				<td>{{ $atributo -> ATRI_DESCRIPCION }}</td>
				<td>{{ $atributo -> ATRI_OBSERVACIONES }}</td>
				<td>{{ $atributo -> ATRI_CREADOPOR }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('cnfg-contratos.atributos.edit', [ 'ATRI_ID' => $atributo->ATRI_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fas fa-edit" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fas fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $atributo->ATRI_ID,
						'data-modelo'=> str_upperspace(class_basename($atributo)),
						'data-descripcion'=> $atributo->ATRI_DESCRIPCION,
						'data-action'=>'atributos/'. $atributo->ATRI_ID,
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