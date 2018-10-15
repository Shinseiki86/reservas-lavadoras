@extends('layouts.menu')
@section('page_heading', 'Actualizar Lavadora')

@section('section')
{{ Form::model($lavadora, ['action' => ['Core\LavadoraController@update', $lavadora->LAVA_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}
	
	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/lavadoras'])

{{ Form::close() }}
@endsection