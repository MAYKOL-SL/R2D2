<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Reserva\DetalleReserva;
use Reserva\Ambiente;
use Carbon\Carbon;
use DB;

class PorHoraController extends Controller
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

            

            $reservados=DB::table('detalle_reservas as dr')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereIn('c.Fecha',[$fechaIni,$fechaFin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->where('p.id','=',$periodoBuscado)
            ->select('a.id');


            $ambientes=DB::table('ambientes')
            ->where('capacidad','=',$capacidad)
            ->whereNotIn('id',$reservados)
            ->get();

            return view('porHora.index',["fechaActual"=>$fechaActual,"periodo"=>$periodo,"ambientes"=>$ambientes,"periodoBuscado"=>$periodoBuscado, "fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin,"capacidad"=>$capacidad]);
        }

    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
