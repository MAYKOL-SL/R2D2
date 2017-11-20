<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\Ambiente;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Reserva\TipoFecha;

use DB;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consulta');
    }

    public function consultaPorCapacidad()
    {
        $datos = Ambiente::get(['capacidad']);

        return view('consulta', compact('datos'));
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
        $last_id = DB::table('tipo_fechas')->max('id');

        TipoFecha::create([
            'id' => $last_id + 1,
            'nombre_fecha' => $request->date_end,
            'motivo_feriado' => $request->description
        ]);

        Flash::success("La Fecha fue ingresada correcatamente.");
        return Redirect::to('consulta');
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
