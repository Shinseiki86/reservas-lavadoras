<!DOCTYPE html>
<!--[if IE 8]> <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
<html lang="es" class="no-js">
<!--<![endif]-->
	<head>
		<title>{{env('APP_NAME', 'APP_NAME')}} @yield('title')</title>
		{!! Html::meta( null, 'IE=edge', [ 'http-equiv'=>'X-UA-Compatible' ] ) !!}
		{!! Html::meta( null, 'text/html; charset=utf-8', [ 'http-equiv'=>'Content-Type' ] ) !!}

		{!! Html::meta( 'viewport', 'width=device-width, initial-scale=1') !!}
		<meta content="" name="description"/>
		<meta content="" name="author"/>

		{!! Html::style('assets/stylesheets/bootstrap/bootstrap.min.css') !!}
		{!! Html::style('assets/stylesheets/bootstrap/bootstrap-theme.min.css') !!}
		{!! Html::style('assets/stylesheets/bootstrap/bootstrap-navbar-custom.css') !!}
		{!! Html::style('assets/stylesheets/font-awesome/fontawesome.min.css') !!}
		{!! Html::style('assets/stylesheets/font-awesome/solid.min.css') !!}
		{!! Html::style('assets/stylesheets/font-awesome/brands.min.css') !!}
		{!! Html::style('assets/stylesheets/metisMenu.min.css') !!}
		{!! Html::style('assets/stylesheets/pace-theme-flash.css') !!}
		{!! Html::script('assets/scripts/pace.min.js') !!}
		{!! Html::style('assets/stylesheets/sb-admin-2.css') !!}
		{!! Html::style('assets/stylesheets/dropdown-menu.css') !!}
		{!! Html::style('assets/stylesheets/toastr.min.css') !!}

		@stack('head')
	</head>

	<body class="sidebar-closed">
		@yield('body')

		{!! Html::script('assets/scripts/jquery/jquery.min.js') !!}
		{!! Html::script('assets/scripts/bootstrap/bootstrap.min.js') !!}
		{!! Html::script('assets/scripts/metisMenu.min.js') !!}
		{!! Html::script('assets/scripts/sb-admin-2.js') !!}
		{!! Html::script('assets/scripts/toastr.min.js') !!}
		<script type="text/javascript">
			$(function () {
				//Si el formulario presenta error, realizará focus al primer elemento con error.
				@if(isset($errors))
					$('#{{current($errors->keys())}}').focus();
				@endif

				//Configuración Toast
				toastr.options.closeMethod = 'fadeOut';
				toastr.options.closeDuration = 2000;
				toastr.options.closeEasing = 'swing';
				toastr.options.progressBar = true;
				toastr.options.positionClass = 'toast-top-left';

				//Activa los tooltip de Boostrap
				tooltips = $('[data-tooltip="tooltip"]');
				if(tooltips.length > 0)
					tooltips.tooltip();
			});
		</script>
		@stack('scripts')

		@stack('modals')
		@include('widgets.modal-loading')

		<footer class="footer {{ !env('APP_DEBUG', false) ? 'navbar-custom1' : 'navbar-custom2'}} navbar-fixed-bottom">
			<div class="text-right" style="color: #b9b9b9;padding-right:20px;">
				<small>{{env('APP_NAME', 'APP_NAME')}}&copy; powered by <i>diheke</i></small>
			</div>
		</footer>
	</body>
</html>