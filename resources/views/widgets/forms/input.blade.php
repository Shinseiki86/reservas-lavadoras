<div class="col-xs-{{isset($column)?$column:12}} {{isset($hidden)?'hide':''}}"> 
	<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
		{{ Form::label($name, $label,  [ 'class' => 'control-label' ], false) }}
		@include('widgets.forms.input-'.$type, compact('name','value','options','data','ajax','multiple','class'))
		@include('widgets.forms.alerta',compact('name'))
	</div>
</div>