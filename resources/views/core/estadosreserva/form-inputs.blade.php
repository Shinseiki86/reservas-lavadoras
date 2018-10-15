{{--@include('datepicker')--}}
{{--@include('select2')--}}

@include('widgets.forms.input', ['type'=>'text', 'name'=>'LAVA_DESCRIPCION', 'label'=>'Descripción', 'options'=>['maxlength' => '300', 'required'] ])

@include('widgets.forms.input', ['type'=>'text', 'name'=>'LAVA_CAPACIDAD', 'label'=>'Capacidad', 'options'=>['required'] ])

@include('widgets.forms.input', [ 'type'=>'textarea', 'name'=>'LAVA_OBSERVACIONES', 'label'=>'Observaciones', 'options'=>['maxlength' => '300'] ])
