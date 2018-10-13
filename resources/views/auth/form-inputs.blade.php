@include('select2')

@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'username', 'label'=>'Nombre de Usuario','options'=>['maxlength' => '30']])

@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'name', 'label'=>'Nombre', 'options'=>['maxlength' => '100'] ])

@include('widgets.forms.input', ['type'=>'number', 'column'=>4, 'name'=>'cedula', 'label'=>'Cédula', 'options'=>['size' => '999999999999999'] ])

@include('widgets.forms.input', ['type'=>'email', 'column'=>8, 'name'=>'email', 'label'=>'Correo electrónico'])

@include('widgets.forms.input', ['type'=>'select', 'name'=>'roles_ids', 'label'=>'Roles', 'data'=>$arrRoles, 'multiple'=>true,])

@include('widgets.forms.input', ['type'=>'select', 'name'=>'EMPL_ids', 'label'=>'Empleadores', 'data'=>$arrEmpleadores, 'multiple'=>true,])

@include('widgets.forms.input', ['type'=>'select', 'name'=>'GERE_ids', 'label'=>'Gerencias', 'data'=>$arrGerencias, 'multiple'=>true,])

@include('widgets.forms.input', ['type'=>'select', 'name'=>'TEMP_ids', 'label'=>'Temporales', 'data'=>$arrTemporales, 'multiple'=>true,])


