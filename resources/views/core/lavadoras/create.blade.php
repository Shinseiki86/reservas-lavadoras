@extends('layouts.menu')
@section('page_heading', 'Nuevo Lavadora')

@section('section')
{{ Form::open(['route' => 'core.lavadoras.store', 'class' => 'form-horizontal']) }}
	
	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/lavadoras'])

{{ Form::close() }}
@endsection
