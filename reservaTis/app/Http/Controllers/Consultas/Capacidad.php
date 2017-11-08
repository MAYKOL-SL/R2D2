<?php

namespace Reserva\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\Ambiente;
use Reserva\DetalleReserva;

use DB;

class Capacidad extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Consultas.capacidad.consulta_main_capacidad');
    }

    public function consultaPorCapacidad()
    {
        $capacidad = Input::get('numero', false);
        //$datos = Ambiente::get(['nombre_aula', 'capacidad', 'ubicacion']);
        $datos = DB::table('ambientes')
            ->join('detalle_reservas', 'ambientes.id', '=', 'detalle_reservas.reserva_id')
            ->where('detalle_reservas.estado', '=', 'Inactivo')
            ->where('ambientes.capacidad', '>=', $capacidad)  
                    ->get();

/**
 * $datos = DB::table('ambientes')
                    ->where('capacidad', '>=', $capacidad)  
                    ->get();
 * [$datos description]
 * @var [type]
 */
        

        return view('Consultas.capacidad.consulta_second_capacidad', compact('datos'));
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
