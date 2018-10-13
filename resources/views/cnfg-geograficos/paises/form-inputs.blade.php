<div class='col-md-8 col-md-offset-2'>
	
	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'PAIS_CODIGO', 'label'=>'Código', 'options'=>['maxlength' => '25'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'PAIS_NOMBRE', 'label'=>'Descripción', 'options'=>['maxlength' => '300'] ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'cnfg-geograficos/paises'])

</div>