<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','PrincipalController@index');


Route::resource('admin/permissions', 'Admin\\PermissionsController');
Route::resource('admin/roles', 'Admin\\RolesController');
Route::resource('admin/users', 'Admin\\UsersController');
Route::get('regAula','regController@regAula');

Route::resource('reserva', 'Reservacion\\StateController');
Route::resource('reserva_capacidad', 'Reservacion\\ReservaController');
Route::get('towns/{id}','Reservacion\\StateController@getTowns');


//Route::get('calendario','CalendarioController@vistaCalendario');
//Route::get('consulta', 'ConsultasController@consultaPorCapacidad');

Route::resource('CrearAmbiente','CrearAmbiente\\CrearAmbienteController');
Route::get('CrearAmbiente/{id}/destroy',[
	'uses' => 'CrearAmbiente\\CrearAmbienteController@destroy',
	'as' => 'CrearAmbiente.destroy'
]);

Route::resource('tiposambiente', 'tipoDeAmbiente\\tipoDeAmbienteController');
Route::get('tiposambiente/{id}/destroy',[
	'uses' => 'tipoDeAmbiente\\tipoDeAmbienteController@destroy',
	'as' => 'tiposambiente.destroy'
]);



//Route::resource('reserva', 'StateController');
//Route::get('towns/{id}','StateController@getTowns');



Route::resource('tiposReserva', 'tipoDeReserva\\tipoDeReservaController');
Route::get('towns/{id}','tipoDeReserva\\tipoDeReservaController@getTowns');


Route::resource('ambiente','AmbienteController');
Route::resource('porAmbiente.create','AmbienteController.create');
Route::resource('complemento','Complementos\\ComplementoController');
Route::get('complemento/{id}/destroy',[
	'uses' => 'Complementos\\ComplementoController@destroy',
	'as' => 'complemento.destroy'
]);


//Route::get('calendario','CalendarioController@vistaCalendario');
//Rutas para el calendario
Route::get('calendario','CalendarioController@getDatosReserva');
Route::resource('calendario', 'CalendarioController', ['only' => ['getDatosReserva', 'store']]);
//Route::put('calendario', 'CalendarioController@store');

Route::get('get_excel_calendario','CalendarioController@getDatosCalendario');
//Pensar acerca de donde colocar la lectura del excel o talvez ya va estar preestablecido.
Route::resource('leer_datos_excel', 'CalendarioController@loadCalendar');
//Route::resource('events','CalendarioController@index');
Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
Route::resource('calendario_main', 'CalendarMainController@getDatosReserva');


//Rutas para Consulta por capacidad
Route::get('Consultas/capacidad/consulta_main_capacidad', 'Consultas\\Capacidad@index');
Route::post('Consultas/capacidad/consulta_main_capacidad', 'Consultas\\Capacidad@consultaPorCapacidad');


Route::resource('reservas', 'ReservasController');
Route::resource('porHora', 'PorHoraController');
Route::resource('porCapacidad', 'PorCapacidadController');


Route::get('busquedaFecha', 'BusquedaFechas\\BusqFechasController@find');
