{{--@include('datepicker')--}}
{{--@include('select2')--}}

@include('widgets.forms.input', ['type'=>'text', 'name'=>'ATRI_DESCRIPCION', 'label'=>'Descripción', 'options'=>['maxlength' => '300', 'required'] ])

@include('widgets.forms.input', [ 'type'=>'textarea', 'name'=>'ATRI_OBSERVACIONES', 'label'=>'Observaciones', 'options'=>['maxlength' => '300'] ])
