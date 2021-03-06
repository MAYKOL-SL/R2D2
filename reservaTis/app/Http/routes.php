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

Route::resource('calendario_main', 'CalendarMainController@getDatosReserva');
Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');


Route::group(['middleware' => ['auth','admin']], function (){

			Route::resource('admin/permissions', 'Admin\\PermissionsController');
			Route::resource('admin/roles', 'Admin\\RolesController');
			Route::resource('admin/users', 'Admin\\UsersController');
			Route::resource('events','CalendarioController@index');
			Route::get('regAula','regController@regAula');

			Route::resource('reserva', 'Reservacion\\StateController');
			Route::get('towns/{id}','Reservacion\\StateController@getTowns');


			Route::resource('CrearAmbiente','CrearAmbiente\\CrearAmbienteController');
			Route::get('CrearAmbiente/{id}/destroy',[
				'uses' => 'CrearAmbiente\\CrearAmbienteController@destroy',
				'as' => 'CrearAmbiente.destroy'
			]);

			Route::resource('CrearComplementoAmbiente','CrearAmbiente\\CrearComplementoAmbienteController');

			Route::resource('tiposambiente', 'tipoDeAmbiente\\tipoDeAmbienteController');
			Route::get('tiposambiente/{id}/destroy',[
				'uses' => 'tipoDeAmbiente\\tipoDeAmbienteController@destroy',
				'as' => 'tiposambiente.destroy'
			]);


			Route::resource('tiposReserva', 'tipoDeReserva\\tipoDeReservaController');

			Route::get('towns/{id}','tipoDeReserva\\tipoDeReservaController@getTowns');

			Route::resource('ambiente','AmbienteController');
			Route::resource('complemento','Complementos\\ComplementoController');
			Route::get('complemento/{id}/destroy',[
				'uses' => 'Complementos\\ComplementoController@destroy',
				'as' => 'complemento.destroy'
			]);

// Calendario Administrador

			Route::get('calendario','CalendarioController@getDatosReserva');
			Route::resource('calendario', 'CalendarioController', ['only' => ['getDatosReserva', 'store']]);
			Route::get('get_excel_calendario','CalendarioController@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioController@loadCalendar');




			Route::get('calendario','CalendarioController@getDatosReserva');
			//Route::post('calendario/{id}', 'CalendarioController@destroy');
			Route::resource('calendario', 'CalendarioController', ['only' => ['store']]);
			Route::any('calendario/{id}',['uses'=>'CalendarioController@destroy']);


			Route::get('get_excel_calendario','CalendarioController@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioController@loadCalendar');
//---------------------------------------------------------------------------------------------



			Route::get('Formulario/form_cargar_calendario_academico', 'CalendarioController@form_cargar_calendario_academico');
			Route::post('Formulario/cargar_calendario_academico', 'CalendarioController@cargar_calendario_academico');


  		//para insertar Fechas Conmemorativas ----
  		Route::get('consulta', 'ConsultasController@index');
		Route::resource('consulta', 'ConsultasController', ['only' => ['store']]);
			//------

			Route::resource('porHora', 'PorHoraController');
			Route::resource('porCapacidad', 'PorCapacidadController');

			Route::get('busquedaFecha', 'BusquedaFechas\\BusqFechasController@find');
			Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');

			Route::resource('reservas', 'ReservasController');
			Route::get('Reservas/{id}/destroy',['uses'=>'ReservasController@destroy','as'=>'reservas.destroy']);
			Route::get('Detalles/{id}/destroy',['uses'=>'DetalleReserva\\DetalleReservaController@destroy','as'=>'detalle.destroy']);

			Route::get('reser/resConComplemento','ReservasController@verReservaConComplemento');


			Route::resource('ConfirmarReserva', 'ConfirmarReserva\\ConfirmarReservaController');
			Route::resource('Confirm','ConfirmarReserva\\ConfirmarReservaController');
			Route::get('Confirm/{id}/destroy',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@destroy' ,'as'=>'Confirm.destroy']);
			Route::get('Confirm/{id}/store',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@store' ,'as'=>'Confirm.store']);

			/*ultimo anadido para abteener los ambiente de una facultad*/
		     Route::get('ambienteFacu/{id}','PorHoraController@getAmbientes');
				 Route::resource('facultad', 'FacultadController');

				 Route::get('facultad/{id}/destroy',[
	 				'uses' => 'FacultadController@destroy',
	 				'as' => 'facultad.destroy'
	 			]);


});

//Docente

Route::group(['middleware' => ['auth','docente']], function (){
  Route::resource('reservas', 'ReservasController');
	Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');
  Route::resource('ambiente','AmbienteController');
	Route::resource('porHora', 'PorHoraController');
	Route::resource('porCapacidad', 'PorCapacidadController');




			Route::get('busquedaFecha', 'BusquedaFechas\\BusqFechasController@find');
			Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');
			Route::resource('reservas', 'ReservasController');
			Route::get('Reservas/{id}/destroy',['uses'=>'ReservasController@destroy','as'=>'reservas.destroy']);
			Route::get('Detalles/{id}/destroy',['uses'=>'DetalleReserva\\DetalleReservaController@destroy','as'=>'detalle.destroy']);
			Route::get('reser/resConComplemento','ReservasController@verReservaConComplemento');
			Route::resource('ConfirmarReserva', 'ConfirmarReserva\\ConfirmarReservaController');
			Route::resource('Confirm','ConfirmarReserva\\ConfirmarReservaController');
			Route::get('Confirm/{id}/destroy',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@destroy' ,'as'=>'Confirm.destroy']);
			Route::get('Confirm/{id}/store',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@store' ,'as'=>'Confirm.store']);

			Route::resource('CrearComplementoAmbiente','CrearAmbiente\\CrearComplementoAmbienteController');


//Calendario para Docente, Secretaria Y Auxiliar
Route::get('calendario_docente_secre_aux','CalendarioControllerDocenteSecreAux@getDatosReserva');
			Route::resource('calendario_docente_secre_aux', 'CalendarioControllerDocenteSecreAux', ['only' => ['getDatosReserva', 'store']]);
			Route::get('get_excel_calendario','CalendarioControllerDocenteSecreAux@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioControllerDocenteSecreAux@loadCalendar');




			Route::get('calendario_docente_secre_aux','CalendarioControllerDocenteSecreAux@getDatosReserva');
			//Route::post('calendario/{id}', 'CalendarioController@destroy');
			Route::resource('calendario_docente_secre_aux', 'CalendarioControllerDocenteSecreAux', ['only' => ['store']]);
			Route::any('calendario_docente_secre_aux/{id}',['uses'=>'CalendarioControllerDocenteSecreAux@destroy']);


			Route::get('get_excel_calendario','CalendarioControllerDocenteSecreAux@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioControllerDocenteSecreAux@loadCalendar');
//---------------------------------------------------------------------------------------------
      /*ultimo anadido para abteener los ambiente de una facultad*/
	    Route::get('ambienteFacu/{id}','PorHoraController@getAmbientes');


});

//Secretaria
Route::group(['middleware' => ['auth','secret']], function (){
		Route::resource('reservas', 'ReservasController');
		Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');
		Route::resource('ambiente','AmbienteController');
		Route::resource('porHora', 'PorHoraController');
		Route::resource('porCapacidad', 'PorCapacidadController');



			Route::get('busquedaFecha', 'BusquedaFechas\\BusqFechasController@find');
			Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');
			Route::resource('reservas', 'ReservasController');
			Route::get('Reservas/{id}/destroy',['uses'=>'ReservasController@destroy','as'=>'reservas.destroy']);
			Route::get('Detalles/{id}/destroy',['uses'=>'DetalleReserva\\DetalleReservaController@destroy','as'=>'detalle.destroy']);
			Route::get('reser/resConComplemento','ReservasController@verReservaConComplemento');
			Route::resource('ConfirmarReserva', 'ConfirmarReserva\\ConfirmarReservaController');
			Route::resource('Confirm','ConfirmarReserva\\ConfirmarReservaController');
			Route::get('Confirm/{id}/destroy',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@destroy' ,'as'=>'Confirm.destroy']);
			Route::get('Confirm/{id}/store',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@store' ,'as'=>'Confirm.store']);

			Route::resource('CrearComplementoAmbiente','CrearAmbiente\\CrearComplementoAmbienteController');



//Calendario para Docente, Secretaria Y Auxiliar
Route::get('calendario_docente_secre_aux','CalendarioControllerDocenteSecreAux@getDatosReserva');
			Route::resource('calendario_docente_secre_aux', 'CalendarioControllerDocenteSecreAux', ['only' => ['getDatosReserva', 'store']]);
			Route::get('get_excel_calendario','CalendarioControllerDocenteSecreAux@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioControllerDocenteSecreAux@loadCalendar');




			Route::get('calendario_docente_secre_aux','CalendarioControllerDocenteSecreAux@getDatosReserva');
			//Route::post('calendario/{id}', 'CalendarioController@destroy');
			Route::resource('calendario_docente_secre_aux', 'CalendarioControllerDocenteSecreAux', ['only' => ['store']]);
			Route::any('calendario_docente_secre_aux/{id}',['uses'=>'CalendarioControllerDocenteSecreAux@destroy']);


			Route::get('get_excel_calendario','CalendarioControllerDocenteSecreAux@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioControllerDocenteSecreAux@loadCalendar');
//---------------------------------------------------------------------------------------------
      /*ultimo anadido para abteener los ambiente de una facultad*/
	     Route::get('ambienteFacu/{id}','PorHoraController@getAmbientes');


});

//Auxiliar
Route::group(['middleware' => ['auth','auxi']], function (){
	  Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');
    Route::resource('reservas', 'ReservasController');



			Route::get('busquedaFecha', 'BusquedaFechas\\BusqFechasController@find');
			Route::resource('DetalleReserva','DetalleReserva\\DetalleReservaController');
			Route::resource('reservas', 'ReservasController');
			Route::get('Reservas/{id}/destroy',['uses'=>'ReservasController@destroy','as'=>'reservas.destroy']);
			Route::get('Detalles/{id}/destroy',['uses'=>'DetalleReserva\\DetalleReservaController@destroy','as'=>'detalle.destroy']);
			Route::get('reser/resConComplemento','ReservasController@verReservaConComplemento');
			Route::resource('ConfirmarReserva', 'ConfirmarReserva\\ConfirmarReservaController');
			Route::resource('Confirm','ConfirmarReserva\\ConfirmarReservaController');
			Route::get('Confirm/{id}/destroy',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@destroy' ,'as'=>'Confirm.destroy']);
			Route::get('Confirm/{id}/store',['uses'=>'ConfirmarReserva\\ConfirmarReservaController@store' ,'as'=>'Confirm.store']);

			Route::resource('CrearComplementoAmbiente','CrearAmbiente\\CrearComplementoAmbienteController');


//Calendario para Docente, Secretaria Y Auxiliar
Route::get('calendario_docente_secre_aux','CalendarioControllerDocenteSecreAux@getDatosReserva');
			Route::resource('calendario_docente_secre_aux', 'CalendarioControllerDocenteSecreAux', ['only' => ['getDatosReserva', 'store']]);
			Route::get('get_excel_calendario','CalendarioControllerDocenteSecreAux@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioControllerDocenteSecreAux@loadCalendar');




			Route::get('calendario_docente_secre_aux','CalendarioControllerDocenteSecreAux@getDatosReserva');
			//Route::post('calendario/{id}', 'CalendarioController@destroy');
			Route::resource('calendario_docente_secre_aux', 'CalendarioControllerDocenteSecreAux', ['only' => ['store']]);
			Route::any('calendario_docente_secre_aux/{id}',['uses'=>'CalendarioControllerDocenteSecreAux@destroy']);


			Route::get('get_excel_calendario','CalendarioControllerDocenteSecreAux@getDatosCalendario');
			//Route::resource('get_reservas','CalendarioController@getDatosFullCalendar');
			Route::resource('leer_datos_excel', 'CalendarioControllerDocenteSecreAux@loadCalendar');
//---------------------------------------------------------------------------------------------




});
