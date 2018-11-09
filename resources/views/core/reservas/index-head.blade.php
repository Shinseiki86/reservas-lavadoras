@push('head')
	{!! Html::style('assets/stylesheets/fullcalendar.css') !!}

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<style type="text/css">
		.modal-header-reserva {
			background-color: #286090;
			color:white !important;
			text-align: center;
			font-size: 25px;
			border-radius:6px;
		}
		.btn-primaryy {
			-webkit-border-radius: 8;
			-moz-border-radius: 8;
			border-radius: 8px;
			font-family: Arial;
			color: #ffffff;
			font-size: 28px;
			background: #265a88;
			padding: 10px 23px 10px 20px;
			text-decoration: none;
		}
		.btn-primaryy:hover {
			background: #23527c;
			color: #ffffff;
		  	text-decoration: none;
		}
		.btn-primaryy:focus {
		  	background: #23527c;
		  	color: #ffffff;
		 	text-decoration: none;
		}

		table.status-legend {
			width:100px;
			border: solid 1px #999;
		}
		.fc-title{color: black;}

		.estados {
			z-index: 8;
			width:100px;
			border-radius: 8px;
		}
		.estados+.aprobada {
			background-color: rgb(0, 255, 0);
		}
		.estados+.pendiente {
			background-color: rgb(255, 255, 0);
		}
		.estados+.anulada {
			background-color: rgb(204, 204, 204);
		}
		.estados+.activada {
			background-color: cyan;
		}
	</style>
@endpush