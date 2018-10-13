{{--@include('datepicker')--}}
{{-- @include('select2') --}}

@include('widgets.forms.input', ['type'=>'text', 'name'=>'PAGE_DESCRIPCION', 'label'=>'Descripción', 'options'=>['maxlength' => '100', 'required'] ])

@include('widgets.forms.input', ['type'=>'text', 'name'=>'PAGE_VALOR', 'label'=>'Valor', 'options'=>['maxlength' => '100', 'required'] ])

@include('widgets.forms.input', [ 'type'=>'textarea', 'name'=>'PAGE_OBSERVACIONES', 'label'=>'Observaciones', 'options'=>['maxlength' => '300'] ])