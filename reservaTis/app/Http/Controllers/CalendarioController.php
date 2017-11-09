<?php

namespace Reserva\Http\Controllers;

use Illuminate\Database\Schema\R2D2;
use Illuminate\Http\Request;
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
        $data = Fullcalendarevento::get(['start', 'end', 'title', 'color']);
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

    public function getDatosReserva()
    {
        $borrar = Fullcalendarevento::where('id', '>', 0)->delete();

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
            ->select('reservas.nombre_reserva', 'reservas.start', 'reservas.end', 'reservas.description', 'ambientes.title', 'periodos.hora');

        foreach ($data->get() as $value) {

                    $salto = chr(13).chr(10);
                
                    $nombre_periodo = "Periodo: ";
                    $valor_periodo = $value->hora;
                    $periodo = $nombre_periodo . $valor_periodo;

                    $nombre_reserva = "Reserva: ";
                    $valor_reserva = $value->nombre_reserva;
                    $reserva = $nombre_reserva . $valor_reserva;

                    $nombre_aula = "Aula: ";
                    $valor_aula = $value->title;
                    $aula = $nombre_aula . $valor_aula;

                    $nombre_descripcion = "Descripcion: ";
                    $valor_descripcion = $value->description;
                    $descripcion = $nombre_descripcion. $valor_descripcion;

                    $title_event = $periodo . $salto . $reserva . $salto . $aula . $salto . $descripcion;


                Fullcalendarevento::create([

                    'start' => $value->start,
                    'end' => $value->end,  
                    'title' => $title_event
                ]);
            }

        $hora = Periodo::lists('hora','id');
        $states = TipoAmbiente::lists('tipo_aula','id');   
        return view('calendario',compact('states', 'hora'));
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

                     Calendario::create([
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


            dd($request);
        /**
         
        $salto = chr(13).chr(10);
                
                    $nombre_periodo = "Periodo: ";
                    $valor_periodo = $request->periodos;
                    


                    //$data_periodo = DB::table('periodos')
                    //         ->where('periodos.id' , '=', $valor_periodo)
                    //         ->select('periodos.hora')->get();
                    $periodo = $nombre_periodo . $valor_periodo;


                    $nombre_reserva = "Reserva: ";
                    $valor_reserva = $request->actividad;
                    $reserva = $nombre_reserva . $valor_reserva;

                    $nombre_aula = "Aula: ";
                    $valor_aula = $request->town;
                    $aula = $nombre_aula . $valor_aula;

                    $nombre_descripcion = "Descripcion: ";
                    $valor_descripcion = $request->descripcion;
                    $descripcion = $nombre_descripcion. $valor_descripcion;

                    $title_event = $periodo . $salto . $reserva . $salto . $aula . $salto . $descripcion;

        $fullcalendarevento = new Fullcalendarevento();
        $fullcalendarevento->start = $request->date_start;
        $fullcalendarevento->end = $request->date_end;
        $fullcalendarevento->title = $title_event; 
        $fullcalendarevento->color = $request->color; 
        $fullcalendarevento->save();

        return redirect('calendario');

        * [$salto description]
         * @var [type]
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
        //
    }
}
