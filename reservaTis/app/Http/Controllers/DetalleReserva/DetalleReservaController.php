<?php

namespace Reserva\Http\Controllers\DetalleReserva;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Reserva\Reserva;
use Reserva\DetalleReserva;
use DB;
use Carbon\Carbon;
class DetalleReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request){

            $idreserva=$request->get('idr');
            //dd($idreserva);
            $datosDetalle=DB::table('detalle_reservas')
                            ->where('detalle_reservas.reserva_id','=',$idreserva)
                            ->get();


            $datosListado=DB::table('reservas as r')
                            ->join('detalle_reservas as dr','dr.reserva_id','=','r.id')
                            ->join('ambientes as amb','amb.id','=','dr.ambiente_id')
                            ->join('users as us','us.id','=','r.user_id')
                            ->join('calendarios as cal','cal.id','=','dr.calendario_id')
                            ->join('periodos','periodos.id','=','dr.periodo_id')
                            ->select('r.id as id_reserva','us.name as usuario','amb.title as nombre_aula','r.nombre_reseva as nombre_reserva','r.description','r.start','r.end','cal.Fecha','periodos.hora')

                            ->where('dr.reserva_id','=',$idreserva)
                            //->distinct()
                            ->get()
                            ;
            //dd($datosListado);

           return view('DetalleReserva.index',["reservas"=>$datosListado]);
        }
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
    	$datosDetalle=DB::table('detalle_reserva')
    					->where('detalle_reserva.reserva_id',$id)
    					->get();
    					dd($datosDetalle);

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
