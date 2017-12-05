<?php

namespace Reserva\Http\Controllers;

use Illuminate\Database\Schema\R2D2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Reserva\Http\Requests;
use Reserva\Fullcalendarevento;
use Reserva\Calendario;
use Reserva\Reserva;
use Reserva\Periodo;
use Reserva\Ambiente;
use Reserva\User;
use Reserva\DetalleReserva;
use Reserva\TipoAmbiente;
use Reserva\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Reserva\TipoFecha;
use Laracasts\Flash\Flash;

use Session;
use Storage;
use DB;
use Auth;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * Obetenmos los datos almacenados en la Tabla Calendario,
     * el cual contiene las actividades del calendario academico.
     * Prueba.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Calendario::get(['start', 'title']);
        return Response()->json($data);
    }

    public function getDatosFullCalendar()
    {
        $data = Fullcalendarevento::get(['start', 'end', 'title', 'color', 'id']);
        return Response()->json($data);
    }

    /**
     * Funcion de prueba.
     * @return [type] [description]
     */
    public function getDatosCalendario()
    {
        $data = DB::table('calendarios')
            ->whereNotNull('Actividad')
            ->select('calendarios.Fecha', 'calendarios.Actividad');

        foreach ($data->get() as $value) {

            Fullcalendarevento::create([

                    'start' => $value->Fecha,
                    'title' => $value->Actividad
                ]);
        }

        return Response()->json($data);
    }

    public function vistaCalendario()
    {
       return view('calendario');
    }

    public function getDatosReserva(Request $request)
    {
        $borrar = Fullcalendarevento::where('id_event', '>', 0)->delete();

        $data = DB::table('calendarios')
            ->whereNotNull('Actividad')
            ->select('calendarios.Fecha', 'calendarios.Actividad');

        foreach ($data->get() as $value) {

            Fullcalendarevento::create([
                    'start' => $value->Fecha,
                    'title' => $value->Actividad
                ]);
        }

        $data = DB::table('reservas')
            ->join('detalle_reservas', 'reservas.id', '=', 'detalle_reservas.reserva_id')
            ->join('ambientes', 'detalle_reservas.ambiente_id', '=', 'ambientes.id')
            ->join('periodos', 'detalle_reservas.periodo_id', '=', 'periodos.id')
            ->join('calendarios', 'detalle_reservas.calendario_id', '=', 'calendarios.id')
            ->where('detalle_reservas.estado', '=', 'activo')
            ->select('reservas.nombre_reseva', 'reservas.start', 'reservas.end', 'reservas.description', 'ambientes.title', 'periodos.hora', 'detalle_reservas.id', 'calendarios.Fecha', 'reservas.user_id');

        foreach ($data->get() as $value) {

                    $salto = chr(13).chr(10);
                    $linea = " || ";

                    $nombre_periodo = "Periodo: ";
                    $valor_periodo = $value->hora;
                    $periodo = $nombre_periodo . $valor_periodo;

                    $nombre_reserva = "Reserva: ";
                    $valor_reserva = $value->nombre_reseva;
                    $reserva = $nombre_reserva . $valor_reserva;

                    $nombre_aula = "Aula: ";
                    $valor_aula = $value->title;
                    $aula = $nombre_aula . $valor_aula;

                    $nombre_descripcion = "Descripcion: ";
                    $valor_descripcion = $value->description;
                    $descripcion = $nombre_descripcion. $valor_descripcion;

                    $nombre_usuario = "Usuario: ";
                    $valor_usuario_nombre = $value->user_id;
                    $data_usuario = DB::table('users')
                            ->where('id', '=', $valor_usuario_nombre)
                            ->select('users.name', 'users.apellido');
                    $usuario = "";

                            foreach ($data_usuario->get() as $values) {
                                $espacio = " ";
                                $usuario = $nombre_usuario . $values->name . $espacio . $values->apellido;
                            }



                    $title_event = $linea . $periodo . $salto . $linea . $reserva . $salto . $linea . $aula . $salto . $linea . $descripcion . $salto . $linea . $usuario;


                Fullcalendarevento::create([

                    'id' => $value->id,
                    'start' => $value->Fecha,
                    'end' => $value->Fecha,
                    'title' => $title_event
                ]);
            }

        $user=DB::table('users')->get();
        //$ambiente=DB::table('ambientes')->get();
        //Cuando la reserva tiene conflictos y el que hace la reserva es el Docente y tiene
        //conflictos con la reserva de admin 
        //no aparece las reservas porque solo el admin puede ver todas las reservas 
        //ya que se puso que el docente puede ver sus propias reservas 
        //por tanto no podra ver con quien tiene reserva

        $ambis = Ambiente::search($request->name)->orderBy('title','ASC')->paginate(10);
            $ambis->each(function($ambis){
            $ambis->complementos->lists('nombre_complemento')->ToArray();
            $ambis->tipo_ambiente;
        });


        $hora = Periodo::lists('hora','id');
        $states = TipoAmbiente::lists('tipo_aula','id');
        return view('calendario',compact('states', 'hora', 'user', 'ambis'));
        add('periodos');

        //return Response()->json($data);
       //return view('calendario');
    }

/**
 * Corregir
 * @return [type] [description]
 */
    public function loadCalendar()
    {

        Excel::load('public/calendario.xlsx', function($calendario)
            {

                foreach ($calendario->get() as $value) {

                    //Refrescar la tabla calendarios por hacer..
                    $last_id = DB::table('calendarios')->max('id');

                     Calendario::create([
                     'id' => $last_id + 1,
                     'Fecha' =>$value->fecha,
                     'Dia' =>$value->dia,
                     'Actividad' =>$value->actividad,
                     'created_at' =>$value->creado,
                     'updated_at' =>$value->actualizado
                     ]);
                       }

            });

        return Calendario::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    //leccion 09

    public function form_cargar_calendario_academico(){

       return view('Formulario.form_cargar_calendario_academico');

    }

    public function cargar_calendario_academico(Request $request)
    {

       $archivo = $request->file('archivo');
       $nombre_original=$archivo->getClientOriginalName();
       $extension=$archivo->getClientOriginalExtension();
       $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
       $ruta  =  storage_path('archivos') ."/". $nombre_original;

       if($r1){

            Excel::load($ruta, function($calendario)
             {

                foreach ($calendario->get() as $value) {

                        if(!empty($value->fecha)){

                            //Refrescar la tabla calendarios por hacer..
                            $last_id = DB::table('calendarios')->max('id');

                             Calendario::create([
                             'id' => $last_id + 1,
                             'Fecha' =>$value->fecha,
                             'Dia' =>$value->dia,
                             'Actividad' =>$value->actividad,
                             'created_at' =>$value->creado,
                             'updated_at' =>$value->actualizado
                             ]);
                       }

                    }

             });

            return view("mensajes.msj_correcto")->with("msj"," Calendario Academico Cargado Correctamente");

       }
       else
       {
            return view("mensajes.msj_rechazado")->with("msj","Error al subir el archivo");
       }

    }

    public function store(Request $request)
    {


//datos recogidos
        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];

        $periodos=$request->get('periodos');

        //verificar fechas
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        if ($fecha_ini > $fecha_fin) {
            Flash::warning("fecha Inicio tiene que ser antes que la fecha Fin");
            return Redirect::to('reservas/create');
        }
        //dias
        //$dias;
        $lunes=$request->get( 'lunes');
        $martes=$request->get( 'martes');
        $miercoles=$request->get( 'miercoles');
        $jueves=$request->get( 'jueves');
        $viernes=$request->get( 'viernes');
        $sabado=$request->get( 'sabado');
        $domingo=$request->get( 'domingo');
        if ($lunes==null & $martes==null & $miercoles==null & $jueves==null
             & $viernes==null& $sabado==null & $domingo==null) {
            $dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
        }
        else{
            $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado'),$request->get('domingo')];
        }
        //dd($dias);
        $feriados = TipoFecha::lists('nombre_fecha')->ToArray();
        $ambiente=$request->get('ambiente_id');

        $periodos=$request->get('periodos');
        //fechas a reservar
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->get();
        //dd($fechas);

        $listaFechasDisp=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->lists('calendarios.Fecha');
        //reservados
        $conflictos=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->select('dr.reserva_id as conflicto_id','dr.id as dconflicto_id','dr.periodo_id as pconflicto_id','c.Fecha as Fconflicto')
            ->get();



        $listaFechasConflic=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->lists('c.Fecha');


            $contador = array();
            foreach ($conflictos as $res ) {
                array_push($contador, $res->dconflicto_id);
            }

            $contador=count($contador);
            $cantPer=count($periodos);
            //dd($cantPer);


        //verificar
        if ($contador > 0) {
        ////////si existen conflictos se hace la reserva como inactivo///////////
            $reserva=new Reserva;
            $reserva->estado="inactivo";
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
        /////fin creacion reserva como inactivo///
            foreach ($fechas as $fd) {
                ////si no existe la fechadisponible en la lista de fechas con conflicio entonces se crea la reserva como inactivo





                    for ($i=0; $i < $cantPer; $i++) {
                        $periodoConflic=DB::table('detalle_reservas as dr')->where('estado','=','activo')
                                    ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
                                    ->join('calendarios as c','c.id','=','dr.calendario_id')->where('c.Fecha',$fd->Fecha)
                                    ->whereIn('c.Dia',$dias)
                                    ->join('periodos as p','p.id','=','dr.periodo_id')
                                    ->where('p.id',$periodos[$i])
                                    ->lists('p.hora');

                        if(empty($periodoConflic)){

                            $detres=new DetalleReserva;
                            $detres->estado="activo";
                            $detres->reserva_id=$reserva->id;
                            $detres->calendario_id=$fd->id;
                            $detres->ambiente_id=$ambiente;
                            $detres->periodo_id=$periodos[$i];
                            $detres->save();
                        }
                        else{
                            $detres=new DetalleReserva;
                            $detres->estado="inactivo";
                            $detres->reserva_id=$reserva->id;
                            $detres->calendario_id=$fd->id;
                            $detres->ambiente_id=$ambiente;
                            $detres->periodo_id=$periodos[$i];
                            $detres->save();
                        }


                    }




            }
            $idr=$reserva->id;

            //dd($fechas,$listaFechasConflic);
            Flash::warning("Su reserva tiene conflictos con otras reservas");

            return  redirect()->action('ConfirmarReserva\ConfirmarReservaController@index',compact('idr','ambiente','fecha_ini','fecha_fin','dias','periodos'));;

        }
        ///SI NO EXISTEN CONFLICTOS SE CREA LA RESERVA NORMAL COMO ACTIVO////
        else{
            //registro de reserva
            $reserva=new Reserva;
            $reserva->estado="activo";
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
            //creando la reserva

        //fin de recoger periodos
            foreach ($fechas as $fc) {
                for ($i=0; $i < $cantPer; $i++) {
                    $detres=new DetalleReserva;
                    $detres->estado="activo";
                    $detres->reserva_id=$reserva->id;
                    $detres->calendario_id=$fc->id;
                    $detres->ambiente_id=$ambiente;
                    $detres->periodo_id=$periodos[$i];
                    $detres->save();
                }


            }
            Flash::success("Reserva Añadido!");
            return Redirect::to('reservas');
        }


/**


                //datos recogidos
        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];

        $periodos=$request->get('periodos');

        //verificar fechas
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        if ($fecha_ini > $fecha_fin) {
            Flash::warning("fecha Inicio tiene que ser antes que la fecha Fin");
            return Redirect::to('reservas/create');
        }
        //dias
        $dias;
        $lunes=$request->get( 'lunes');
        $martes=$request->get( 'martes');
        $miercoles=$request->get( 'miercoles');
        $jueves=$request->get( 'jueves');
        $viernes=$request->get( 'viernes');
        $sabado=$request->get( 'sabado');
        $domingo=$request->get( 'domingo');
        if ($lunes==null & $martes==null & $miercoles==null & $jueves==null
             & $viernes==null& $sabado==null & $domingo==null) {
            $dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
        }
        else{
            $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado'),$request->get('domingo')];
        }
        //dd($dias);
        $feriados = TipoFecha::lists('nombre_fecha')->ToArray();
        $ambiente=$request->get('ambiente_id');

        $periodos=$request->get('periodos');
        //fechas a reservar
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->get();
        //dd($fechas);

        $listaFechasDisp=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->lists('calendarios.Fecha');
        //reservados
        $conflictos=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->select('dr.reserva_id as conflicto_id','dr.id as dconflicto_id','dr.periodo_id as pconflicto_id','c.Fecha as Fconflicto')
            ->get();



        $listaFechasConflic=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->lists('c.Fecha')
            ;


            $contador = array();
            foreach ($conflictos as $res ) {
                array_push($contador, $res->dconflicto_id);
            }

            $contador=count($contador);
            $cantPer=count($periodos);
            //dd($cantPer);


        //verificar
        if ($contador > 0) {
        ////////si existen conflictos se hace la reserva como inactivo///////////
            $reserva=new Reserva;
            $reserva->estado="inactivo";
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
        /////fin creacion reserva como inactivo///
            foreach ($fechas as $fd) {
                ////si no existe la fechadisponible en la lista de fechas con conflicio entonces se crea la reserva como inactivo





                    for ($i=0; $i < $cantPer; $i++) {
                        $periodoConflic=DB::table('detalle_reservas as dr')->where('estado','=','activo')
                                    ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
                                    ->join('calendarios as c','c.id','=','dr.calendario_id')->where('c.Fecha',$fd->Fecha)
                                    ->whereIn('c.Dia',$dias)
                                    ->join('periodos as p','p.id','=','dr.periodo_id')
                                    ->where('p.id',$periodos[$i])
                                    ->lists('p.hora')
                                    ;


                        if(empty($periodoConflic)){

                            $detres=new DetalleReserva;
                            $detres->estado="inactivo";
                            $detres->reserva_id=$reserva->id;
                            $detres->calendario_id=$fd->id;
                            $detres->ambiente_id=$ambiente;
                            $detres->periodo_id=$periodos[$i];
                            $detres->save();
                        }


                    }




            }
            $idr=$reserva->id;

            //dd($fechas,$listaFechasConflic);
            Flash::warning("Su reserva tiene conflictos con otras reservas");

            return  redirect()->action('ConfirmarReserva\ConfirmarReservaController@index',compact('idr','ambiente','fecha_ini','fecha_fin','dias','periodos'));;

        }
        ///SI NO EXISTEN CONFLICTOS SE CREA LA RESERVA NORMAL COMO ACTIVO////
        else{
            //registro de reserva
            $reserva=new Reserva;
            $reserva->estado="activo";
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
            //creando la reserva

        //fin de recoger periodos
            foreach ($fechas as $fc) {
                for ($i=0; $i < $cantPer; $i++) {
                    $detres=new DetalleReserva;
                    $detres->estado="activo";
                    $detres->reserva_id=$reserva->id;
                    $detres->calendario_id=$fc->id;
                    $detres->ambiente_id=$ambiente;
                    $detres->periodo_id=$periodos[$i];
                    $detres->save();
                }


            }
            Flash::success("Se ha creado la reserva de forma correcta");
            return Redirect::to('reservas');
        }







//datos recogidos
        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        $dias=[$request->get('lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])->whereIn('Dia',$dias)
        ->get();
        $periodos=$request->get('periodos');

        //verificar fechas
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        if ($fecha_ini > $fecha_fin) {
            Flash::warning("fecha Inicio tiene que ser antes que la fecha Fin");
            return Redirect::to('calendario');
        }
        //dias
        $dias;
        $lunes=$request->get( 'lunes');
        $martes=$request->get( 'martes');
        $miercoles=$request->get( 'miercoles');
        $jueves=$request->get( 'jueves');
        $viernes=$request->get( 'viernes');
        $sabado=$request->get( 'sabado');
        $domingo=$request->get( 'domingo');
        if ($lunes==null & $martes==null & $miercoles==null & $jueves==null
             & $viernes==null& $sabado==null & $domingo==null) {
            $dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
        }
        else{
            $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado'),$request->get('domingo')];
        }
        //dd($dias);
        $feriados = TipoFecha::lists('nombre_fecha')->ToArray();
        $ambiente=$request->get('ambiente_id');

        $periodos=$request->get('periodos');
        //fechas a reservar
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->get();
        //dd($fechas);


        //reservados
        $reservados=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->get();


            $contador = array();
            foreach ($reservados as $res ) {
                array_push($contador, $res->id);
            }

            $contador=count($contador);
            $cantPer=count($periodos);
            //dd($cantPer);


        //verificar
        if ($contador > 0) {
            Flash::success("No se ha creado la reserva:  " . $contador . " fechas estan reservadas!! ");
        }
        else{
            //registro de reserva
            $reserva=new Reserva;
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
            //creando la reserva

        //fin de recoger periodos
            foreach ($fechas as $fc) {
                for ($i=0; $i < $cantPer; $i++) {
                    $detres=new DetalleReserva;
                    $detres->estado="activo";
                    $detres->reserva_id=$reserva->id;
                    $detres->calendario_id=$fc->id;
                    $detres->ambiente_id=$ambiente;
                    $detres->periodo_id=$periodos[$i];
                    $detres->save();
                }


            }
            Flash::success("Se ha creado la reserva de forma correcta");
        }


        return Redirect::to('calendario');



        //datos recogidos
        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('date_start');
        $fecha_fin=$request->get('date_end');
        $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])->whereIn('Dia',$dias)
        ->get();
        $periodos=$request->get('periodos');
        //reservados
        $reservados=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->get();


            $contador = array();
            foreach ($reservados as $res ) {
                array_push($contador, $res->id);
            }

            $contador=count($contador);
            $cantPer=count($periodos);
            //dd($cantPer);


        //verificar
        if ($contador > 0) {
            Flash::success("No se ha creado la reserva:  " . $contador . " fechas estan reservadas!! ");
        }
        else{
            //registro de reserva
            $reserva=new Reserva;
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
            //creando la reserva

        //fin de recoger periodos
            foreach ($fechas as $fc) {
                for ($i=0; $i < $cantPer; $i++) {
                    $detres=new DetalleReserva;
                    $detres->estado="Activo";
                    $detres->reserva_id=$reserva->id;
                    $detres->calendario_id=$fc->id;
                    $detres->ambiente_id=$ambiente;
                    $detres->periodo_id=$periodos[$i];
                    $detres->save();
                }


            }
            Flash::success("Se ha creado la reserva de forma correcta");
        }


        return Redirect::to('calendario');

        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $detalle=DetalleReserva::find($id);

        $idres=DB::table('detalle_reservas')

                    ->select('detalle_reservas.reserva_id')
                    ->where('detalle_reservas.id','=',$id)
                    ->value('reserva_id');

        $idrescount=DB::table('detalle_reservas')

                    ->select('detalle_reservas.reserva_id')
                    ->where('detalle_reservas.reserva_id','=',$idres)
                    ->count();


        $iduser=DB::table('reservas')
                    ->select('reservas.user_id')
                    ->where('reservas.id', '=', $idres)
                    ->value('user_id');


        if(Auth::id() == $iduser || Auth::check() && Auth::user()->hasRole('Administrador')){


        if($idrescount==1){

            $reserva=Reserva::find($idres);
            $detalle->delete();
            $reserva->delete();
            Flash::error("Reservas Eliminadas");
            return redirect::to('calendario');


        }else{

            $detalle->delete();
            Flash::warning("Reserva Eliminada");

            return redirect::to('calendario');

         }

        }

    }
}
