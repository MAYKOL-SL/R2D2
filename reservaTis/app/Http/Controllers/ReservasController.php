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
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Reserva\Periodo;

class ReservasController extends Controller
{
    public function index(Request $request)
    {
            $fechaActual=Carbon::now();
            $fechaActual=$fechaActual->addDay(1);
            $datos=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')
            ->join('calendarios as c','c.id','=','dr.calendario_id')->where('c.Fecha','>',$fechaActual)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->join('reservas as r','r.id','=','dr.reserva_id')
            ->join('users as u','u.id','=','r.user_id')
            ->select('dr.id as id_reserva','u.name as nombre_user','a.title as nombre_aula',
                    'c.fecha','p.hora')
            ->orderBy('id_reserva','asc')
            ->paginate(10);

            //$contador=array(2);
            //$contador=count($contador);
            //Flash::success("hola " . $contador . " prueba!! ");
            return view('reservas.index',["datos"=>$datos]);
        
    }

    
    public function create(Request $request)
    {
        if ($request) {
            $amb_id=$request->get('ambiente_id');
            $fechaActual=Carbon::now();
            $lunes=$request->get('lunes');
            $martes=$request->get('martes');
            $miercoles=$request->get('miercoles');
            $jueves=$request->get('jueves');
            $viernes=$request->get('viernes');
            $sabado=$request->get('sabado');


            $user=DB::table('users')->get();
            $ambiente=DB::table('ambientes')/*->where('id','=',$amb_id)*/->get();
            $periodo=DB::table('periodos')->get();
            $hora = Periodo::lists('hora','id');
            $fechaActual=$fechaActual->addDay(1);
            $fechaIni=$request->get('fecha_ini');
            $fechaFin=$request->get('fecha_fin');

            return view("reservas.create",["ambiente"=>$ambiente,"user"=>$user,"periodo"=>$periodo, "periodos"=>$periodo,"fechaActual"=>$fechaActual,"fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin,"lunes"=>$lunes,"martes"=>$martes,"miercoles"=>$miercoles,"jueves"=>$jueves,"viernes"=>$viernes,"sabado"=>$sabado, "hora"=>$hora]);
        }
        
    }

    
    public function store(Request $request)
    {
        
        //datos recogidos
        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('fecha_ini');
        $fecha_fin=$request->get('fecha_fin');
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
        $reserva=DetalleReserva::findOrFail($id);
        $reserva->estado='inactivo';
        $reserva->update();
        return Redirect::to('reservas');
    }
}
