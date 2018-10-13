@extends('layouts.menu')

@section('page_heading', 'Nuevo País')

@section('section')
{{ Form::open(['route' => 'cnfg-geograficos.paises.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
