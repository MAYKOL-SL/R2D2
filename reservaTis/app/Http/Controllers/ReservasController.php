<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Reserva\Reserva;
use Reserva\DetalleReserva;
use DB;
use Carbon\Carbon;

class ReservasController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $datos=DB::table('detalle_reservas as dr')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')
            ->join('calendarios as c','c.id','=','dr.calendario_id')
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->join('reservas as r','r.id','=','dr.reserva_id')
            ->join('users as u','u.id','=','r.user_id')
            ->select('dr.id as id_reserva','u.name as usuario','a.title as nombre_aula',
                    'c.fecha','p.hora')
            ->paginate(10);
            return view('reservas.index',["reservas"=>$datos]);
        }
    }

    
    public function create(Request $request)
    {
        if ($request) {
            $amb_id=$request->get('ambiente_id');
            $fechaActual=Carbon::now();
            $lunes="lunes";//$request->get('lunes');
            $martes="martes";//$request->get('martes');
            $miercoles="miercoles";//$request->get('miercoles');
            $jueves="jueves";//$request->get('jueves');
            $viernes="viernes";//$request->get('viernes');
            $sabado="sabado";//$request->get('sabado');


            $user=DB::table('users')->get();
            $ambiente=DB::table('ambientes')/*->where('id','=',$amb_id)*/->get();
            $periodo=DB::table('periodos')->get();
            $fechaActual=$fechaActual->addDay(1);
            $fechaIni=$request->get('fecha_ini');
            $fechaFin=$request->get('fecha_fin');

            return view("reservas.create",["ambiente"=>$ambiente,"user"=>$user,"periodo"=>$periodo, "periodos"=>$periodo,"fechaActual"=>$fechaActual,"fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin,"lunes"=>$lunes,"martes"=>$martes,"miercoles"=>$miercoles,"jueves"=>$jueves,"viernes"=>$viernes,"sabado"=>$sabado]);
        }
        
    }

    
    public function store(Request $request)
    {
        $fecha_ini=$request->get('fecha_ini');
        $fecha_fin=$request->get('fecha_fin');
        $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])->whereIn('Dia',$dias)
        ->get();
        
        
        //registro de reserva
        $reserva=new Reserva;
        $reserva->nombre_reseva=$request->get('nombre_reserva');
        $reserva->description=$request->get('description');
        $reserva->start=$fecha_ini;
        $reserva->end=$fecha_fin;
        $reserva->user_id=$request->get('user_id');
        $reserva->save();
        //creado la reserva
        foreach ($fechas as $fc) {
            $detres=new DetalleReserva;
            $detres->reserva_id=$reserva->id;
            $detres->calendario_id=$fc->id;
            $detres->ambiente_id=$request->get('ambiente_id');
            $detres->periodo_id="1";
            $detres->save();
        } 
                   
        
        return Redirect::to('reservas');
    }

    
    public function show($id)
    {
        return view("reservas.show",["reservas"=>reservas::findOrFail($id)]);
    }

    
    public function edit($id)
    {
        $detalleReserva=Reserva::findOrFail($id);
        $calendario=DB::table('calendarios')->get();
        $dia=DB::table('dias')->get();
        $ambiente=DB::table('calendarios')->get();
        $user=DB::table('users')->get();
        return view("reserva.edit",["reserva"=>$reserva,"calendario"=>$calendario,"dia"=>$dia,"ambiente"=>$ambiente,"user"=>$user]);
    }

    
    public function update(Request $request, $id)
    {
        $reserva=DetalleReserva::findOrFail($id);
        $reserva->calendario_id=$request->get('calendario_id');
        $reserva->dia_id=$request->get('dia_id');
        $reserva->ambiente_id=$request->get('ambiente_id');
        $reserva->user_id='1';
        $reserva->update();
        return Redirect::to('reserva');    }

    
    public function destroy($id)
    {
        $reserva=Reserva::findOrFail($id);
        //$reserva->estado='0';
        $reserva->update();
        return Redirect::to('reserva');
    }
}
