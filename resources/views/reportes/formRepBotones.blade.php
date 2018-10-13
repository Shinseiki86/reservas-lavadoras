<!-- Botones -->
<div class="text-right" style="position: absolute; right: 20px; z-index: 100">
	{{ Form::button('<i class="fas fa-undo" aria-hidden="true"></i>', [
		'class'=>'btn btn-warning',
		'type'=>'reset',
		'data-tooltip'=>'tooltip',
		'title'=>'Reset',
	]) }}
	{{ Form::button('<i class="fas fa-cog" aria-hidden="true"></i>', [
		'class'=>'btn btn-primary',
		'type'=>'submit',
		'data-tooltip'=>'tooltip',
		'title'=>'Procesar',
	]) }}
</div>