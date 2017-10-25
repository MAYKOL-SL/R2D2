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
Route::resource('events','CalendarioController@index');
Route::get('regAula','regController@regAula');

Route::resource('reserva', 'Reservacion\\StateController');
Route::get('towns/{id}','Reservacion\\StateController@getTowns');


Route::get('calendario','CalendarioController@vistaCalendario');
Route::get('consulta', 'ConsultasController@consultaPorCapacidad');

Route::resource('tiposReserva', 'tipoDeReserva\\tipoDeReservaController');

Route::get('towns/{id}','tipoDeReserva\\tipoDeReservaController@getTowns');

Route::resource('ambiente','AmbienteController');
Route::resource('porAmbiente.create','AmbienteController.create');

Route::get('calendario','CalendarioController@vistaCalendario');
Route::get('consulta', 'ConsultasController@consultaPorCapacidad');

Route::resource('reservas', 'ReservasController');
