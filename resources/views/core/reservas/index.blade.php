@extends('layouts.menu')
@section('title', '/ Reservas')
@include('datepicker')
@include('select2')

@rinclude('index-head')
@rinclude('index-scripts')


@section('section')
<div class="panel panel-default">

	<div class="panel-heading">
		<div class="row">
			<div class="col-xs-8">
				<h2>Calendario de Reservas</h2>
			</div>
			<div  class="col-xs-4 text-right" id="btn-create" class="col-xs-3 col-md-9 col-lg-9">
				<a class='btn btn-primary btn-lg' role='button' data-toggle="modal" data-target="#modalcrearres" href="#">
					<i class="fa fa-plus" aria-hidden="true"></i> 
					<span class="hidden-xs">Crear Reserva</span>
					<span class="sr-only">Crear</span>
				</a>
			</div>	
		</div>
	</div>
		

	<div class="panel-body"> <!-- Main content -->

		<div class="row">
			<div class="col-xs-12 col-sm-12"> <!-- col des. estados -->

				<table class="col-xs-12 col-sm-12" class="status-legend" cellspacing="1">
					<tbody>
						<tr>
							<td class="estados hide"></td>
							<td class="estados aprobada">APROBADA</td>
							<td class="estados pendiente">PENDIENTE POR APROBAR</td>
							{{-- <td class="estados anulada">ANULADA</td> --}}
						</tr>
					</tbody>
				</table>

			</div>

			<div class="col-xs-12 col-sm-12"> <!-- col calendar -->
				<div class="box box-primary">
					<div class="box-body no-padding">
						<!-- THE CALENDAR -->
						<div id="calendar"></div>
					</div><!-- /.box-body -->
				</div> <!-- /. box -->
			</div> <!-- /.col calendar -->
		</div> <!-- /.row -->
		<!-- /.Main content -->
  	</div><!-- /.panel-body -->
  
</div><!-- /.panel -->


@rinclude('index-modalCrearReservas')

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalReserva" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header modal-header-reserva" style="padding:40px 50px;">		
		<h2><span class="glyphicon glyphicon-modal-window"></span> Detalle Reserva</h2>
	  </div>
	  <div class="modal-body" id="divmodal" style="padding:40px 50px;">
	  		AQUÍ VA LA INFO
	  </div>
	  <div class="modal-footer">
				<form id="frmDelete" method="POST" action="" accept-charset="UTF-8" class="frmModal pull-right">
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">
						<i class="fas fa-times" aria-hidden="true"></i> Cerrar
					</button>

					{{ Form::token() }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fas fa-trash" aria-hidden="true"></i> Anular ',[
						'class'=>'btn btn-xs btn-danger',
						'type'=>'submit',
						'data-toggle'=>'modal',
						'data-backdrop'=>'static',
						'data-keyboard'=>'false',
						//'data-target'=>'#msgModalDeleting',
					]) }}
				</form>
          </div>
	</div>
  </div>
</div>



<!-- Mensaje Modal al borrar registro. Bloquea la pantalla mientras se procesa la solicitud -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="msgModalProcessing" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<h4>
					<i class="fa fa-cog fa-spin fa-3x fa-fw" style="vertical-align: middle;"></i> Cargando...
				</h4>
			</div>
		</div>

	</div>
</div><!-- Fin de Mensaje Modal al borrar registro.-->

{{-- @include('reservas/index-modalReservasPorDias') --}}

<div id="errorAjax"></div>
@endsection