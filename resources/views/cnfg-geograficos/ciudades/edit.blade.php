@extends('layouts.menu')

@section('page_heading', 'Actualizar Ciudad')

@section('section')
{{ Form::model($ciudad, ['action' => ['CnfgGeograficos\CiudadController@update', $ciudad->CIUD_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection