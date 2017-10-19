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

Route::resource('reserva', 'Reservacion\\ReservacionController');
Route::resource('tiposReserva', 'tipoDeReserva\\tipoDeReservaController');
<<<<<<< HEAD
Route::resource('reservas', 'ReservasController');
=======


Route::get('calendario','CalendarioController@vistaCalendario');
Route::get('consulta', 'ConsultasController@consultaPorCapacidad');


>>>>>>> 07b3d01663933a7f1cea7554d9f87343ad1186d3
