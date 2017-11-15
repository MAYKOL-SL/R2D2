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
use Reserva\DetalleReserva;
use Reserva\TipoAmbiente;
use Reserva\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

use Storage;
use DB;

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
            ->select('reservas.nombre_reseva', 'reservas.start', 'reservas.end', 'reservas.description', 'ambientes.title', 'periodos.hora', 'detalle_reservas.id');

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

                    $title_event = $linea . $periodo . $salto . $linea . $reserva . $salto . $linea . $aula . $salto .$linea . $descripcion;


                Fullcalendarevento::create([

                    'id' => $value->id,
                    'start' => $value->start,
                    'end' => $value->end,
                    'title' => $title_event
                ]);
            }
        
        $user=DB::table('users')->get();
        $ambiente=DB::table('ambientes')->get();


        $hora = Periodo::lists('hora','id');
        $states = TipoAmbiente::lists('tipo_aula','id');
        return view('calendario',compact('states', 'hora', 'user', 'ambiente'));
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

       return view("formulario.form_cargar_calendario_academico");

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
        
      
        if($idrescount==1){

            $reserva=Reserva::find($idres);
            $detalle->delete();
            $reserva->delete();
            Flash::error("Todas las reservas han sido eliminadas");
            return redirect::to('calendario');


        }else{

            $detalle->delete();
            Flash::warning("La Reserva ha sido eliminada");

            return redirect::to('calendario');

         }
        
       

      
    }
}
