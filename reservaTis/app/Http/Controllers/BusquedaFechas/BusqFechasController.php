<?php

namespace Reserva\Http\Controllers\BusquedaFechas;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\Reserva;
use DB;

class BusqFechasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find()
    {
         $busqueda = Reserva::select('id')->where('start','=','2017-10-02')->orWhere('end','=','2017-10-23')->get();
         //dd($busgeda);
         $dato='2017-10-02';
         $dato1='2017-10-09';
         $esta='Libre';
         $resultado=DB::select(DB::raw("select am.title ,am.capacidad,am.ubicacion , ca.Fecha , dr.estado
                                        from detalle_reservas AS dr , calendarios AS ca ,ambientes am
                                        where UPPER(dr.calendario_id) like UPPER(ca.id)
                                            AND  UPPER(dr.ambiente_id) like UPPER(am.id)
                                            AND  UPPER(dr.estado) like UPPER('%$esta%')
                                            AND  ca.Fecha >".$dato."
                                            and  ca.Fecha < ".$dato1));


         return $resultado;
    }

    public function FunctionName($value='')
    {
      # code...
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
