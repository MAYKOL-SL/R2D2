<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Reserva\DetalleReserva;
use Reserva\Complemento;
use Reserva\Ambiente;
use Carbon\Carbon;
use DB;

class PorCapacidadController extends Controller
{

    public function index(Request $request)
    {

        if($request)
        {

            $capacidad=$request->get('capacidad');
            $fechaActual=Carbon::now();
            $fechaActual=$fechaActual->addDay(1);
            $periodo=DB::table('periodos')->get();
            $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];

            $fechaIni=$request->get('fechaIni');
            $fechaFin=$request->get('fechaFin');
            $periodoBuscado=$request->get('periodo_id');

            $ComplementoBuscado=$request->get('complementos_id');
            $complementos = Complemento::select('*')->get();

            $reservados=DB::table('detalle_reservas as dr')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereIn('c.Fecha',[$fechaIni,$fechaFin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->where('p.id','=',$periodoBuscado)
            ->select('a.id');


            $ambi=DB::table('ambientes')
            ->where('capacidad','=',$capacidad)
            ->whereNotIn('id',$reservados)
            ->get();

            $ambientes=DB::table('ambientes as amb')
            ->where('capacidad','=',$capacidad)
            ->whereNotIn('id',$reservados)
            ->select('amb.id');

            $ambientesResCom=DB::table('ambientes as am')
            ->join('ambiente_complemento AS ac','ac.ambiente_id','=','am.id')
            ->join('complementos AS com','com.id','=','ac.complemento_id')
            ->where('com.id','=',$ComplementoBuscado)
            ->whereIn('am.id',$ambientes)
            ->get();
             
            /*return view('porCapacidad.index',["fechaActual"=>$fechaActual,"periodo"=>$periodo,"ambientes"=>$ambientes,"periodoBuscado"=>$periodoBuscado, "fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin,"capacidad"=>$capacidad,"complementos"=>$complementos]);*/
             return view('porCapacidad.index',["fechaActual"=>$fechaActual,"periodo"=>$periodo,"ambientes"=>$ambientesResCom,"periodoBuscado"=>$periodoBuscado, "fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin,"capacidad"=>$capacidad,"complementos"=>$complementos]);
            /*return ["fechaActual"=>$fechaActual,"periodo"=>$periodo,"ambientes"=>$ambi,"periodoBuscado"=>$periodoBuscado, "fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin,"capacidad"=>$capacidad,"complementos"=>$complementos,'amc'=>$ambientesResCom];*/
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
