@extends('layouts.menu')

@section('page_heading', 'Nueva Ciudad')

@section('section')
{{ Form::open(['route' => 'cnfg-geograficos.ciudades.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
