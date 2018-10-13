@extends('layouts.menu')
@section('page_heading', 'Actualizar Parametro General')

@section('section')
{{ Form::model($parametrogeneral, ['action' => ['App\ParametroGeneralController@update', $parametrogeneral->PAGE_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'app/parametrosgenerales'])

{{ Form::close() }}
@endsection