<?php

namespace Reserva\Http\Controllers;

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
use Session;
use DB;

class CalendarMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calendario_main');
    }

    public function getDatosReserva()
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
            ->select('reservas.nombre_reseva', 'reservas.start', 'reservas.end', 'reservas.description', 'ambientes.title', 'periodos.hora', 'reservas.id');

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

        return view('calendario_main');
        //return Response()->json($data);
       //return view('calendario');
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
        //
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
