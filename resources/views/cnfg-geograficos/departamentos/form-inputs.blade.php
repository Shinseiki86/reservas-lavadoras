@include('select2')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'DEPA_CODIGO', 'label'=>'Código', 'options'=>['maxlength' => '25'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'DEPA_NOMBRE', 'label'=>'Descripción', 'options'=>['maxlength' => '300'] ])

	@include('widgets.forms.input', ['type'=>'select', 'name'=>'PAIS_ID', 'label'=>'País', 'data'=>$arrPaises])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'cnfg-geograficos/departamentos'])
	
</div>