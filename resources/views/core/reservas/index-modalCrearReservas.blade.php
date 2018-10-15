
@push('scripts')

@endpush

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalcrearres" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content panel-info">

			<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Cerrar</span>
				</button>
				<h4 class="modal-title">Crear Reservas</h4>
			</div>

			<div class="modal-body">
				<div class="form-vertical" role="form">

					@include('widgets.forms.input', ['type'=>'date', 'column'=>6, 'name'=>'RESE_FECHAINICIO', 'label'=>'Fecha del Evento', 'options'=>['required'] ])
					@include('widgets.forms.input', ['type'=>'number', 'column'=>6, 'name'=>'RESE_HORAS', 'label'=>'Horas', 'value'=>1, 'options'=>['required', 'max'=>'12'] ])
					@include('widgets.forms.input', ['type'=>'select', 'name'=>'LAVA_ID', 'label'=>'Lavadora', 'data'=>$arrLavadoras, 'options'=>['required']])

				</div> <!-- end Form -->
			</div>
						
			<div class="modal-footer">
				<button id="btn-reservar" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#msgModalProcessing">
					Crear Reserva
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarmodal">
					Cerrar
				</button>
			</div>
		</div> <!-- end modal-content -->
	</div><!-- end modal-dialog -->
</div>


