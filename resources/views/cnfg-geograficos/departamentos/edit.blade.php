@extends('layouts.menu')

@section('page_heading', 'Actualizar Departamento')

@section('section')
{{ Form::model($departamento, ['action' => ['CnfgGeograficos\DepartamentoController@update', $departamento->DEPA_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection