<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Autenticación
Route::auth();
Route::get('loginWebservice', 'Auth\AuthController@loginWebservice');

Route::group(['prefix'=>'auth', 'namespace'=>'Auth'], function() {
	Route::resource('usuarios', 'AuthController');
	Route::resource('roles', 'RoleController');
	Route::resource('permisos', 'PermissionController');
});
Route::get('password/email/{id}', 'Auth\PasswordController@sendEmail');
Route::get('password/reset/{id}', 'Auth\PasswordController@showResetForm');

Route::group(['prefix'=>'app', 'namespace'=>'App'], function() {
	Route::resource('menu', 'MenuController', ['parameters'=>['menu'=>'MENU_ID']]);
	Route::post('menu/reorder', 'MenuController@reorder')->name('app.menu.reorder');
	Route::get('parameters', 'ParametersController@index')->name('app.parameters');
	Route::get('upload', 'UploadDataController@index')->name('app.upload.index');
	Route::post('upload', 'UploadDataController@upload')->name('app.upload');
	Route::resource('parametrosgenerales', 'ParametroGeneralController');

	/*Route::group(['prefix'=>'artisan', 'as'=>'app.artisan.'], function() {
		$ctrl = 'ArtisanController@';
		Route::get('/', $ctrl.'index', ['as'=>'index']);
		Route::get('clear', $ctrl.'clear', ['as'=>'clear']);
		Route::get('gitPull', $ctrl.'gitPull', ['as'=>'gitPull']);
	});*/
});

Route::group(['middleware'=>'auth'], function() {
	Route::get('/', function(){

        //dd(auth()->check());
		if(Entrust::hasRole(['owner','admin','gesthum']))
			return view('dashboard/charts');
		return view('layouts.menu');
	});
	Route::get('getArrModel', 'Controller@ajax');
});

Route::group(['prefix'=>'reportes', 'namespace'=>'Reportes', 'middleware'=>'auth'], function() {
	Route::get('/', 'ReporteController@index');
	Route::get('/viewForm', 'ReporteController@viewForm');
	
	Route::post('LogsAuditorias', 'RptAuditoriasController@logsAuditoria');
});

Route::group(['prefix'=>'core', 'namespace'=>'Core'], function() {
	//Route::resource('tiposcontratos', 'TipoContratoController', ['parameters'=>['tiposcontratos'=>'TICO_ID']]);
	Route::resource('lavadoras', 'LavadoraController');

	Route::resource('reservas', 'ReservaController', ['parameters'=>['reservas'=>'RESE_ID']]);
	Route::get('reservas/cargaEventos','ReservaController@cargaEventos');
	Route::post('reservas/guardaEventos', array('as' => 'guardaEventos','uses' => 'ReservaController@store'));
	Route::get('reservas/guardarReservas', 'ReservaController@guardarReservas');

	Route::get('reservas/getReservas/{username}', 'ReservaController@getReservas');
	Route::get('reservas/delete/{RESE_ID}', 'ReservaController@delete');
	Route::get('reservas/confirmar/{RESE_ID}', 'ReservaController@confirmar');
	Route::get('reservas/activar/{RESE_ID}', 'ReservaController@activar');
});


