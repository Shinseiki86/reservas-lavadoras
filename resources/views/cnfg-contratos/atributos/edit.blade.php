@extends('layouts.menu')
@section('page_heading', 'Actualizar Atributo')

@section('section')
{{ Form::model($atributo, ['action' => ['CnfgContratos\AtributoController@update', $atributo->ATRI_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}
	
	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'cnfg-contratos/atributos'])

{{ Form::close() }}
@endsection