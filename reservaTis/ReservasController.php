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
use Reserva\TipoFecha;
class ReservasController extends Controller
{
    public function index(Request $request)
    {
            $datos=DB::table('reservas as r')
                        ->join('detalle_reservas as dr','dr.reserva_id','=','r.id')
                        ->join('ambientes as amb','amb.id','=','dr.ambiente_id')
                        ->join('users as us','us.id','=','r.user_id')
                        
                         ->select('r.id as id_reserva','us.name as usuario','amb.title as nombre_aula','r.nombre_reseva as nombre_reserva','r.description','r.start','r.end')
                        
                         ->distinct()
                         ->orderBy('r.id')
                        ->get();
                        //dd($datos);
            return view('reservas.index',["reservas"=>$datos]);
        
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

    	//verificar fechas
    	$fecha_ini=$request->get('fecha_ini');
        $fecha_fin=$request->get('fecha_fin');
    	if ($fecha_ini > $fecha_fin) {
    		Flash::warning("fecha Inicio tiene que ser antes que la fecha Fin");
    		return Redirect::to('reservas/create');
    	}
        //dias
        $dias;
        $lunes=$request->get( 'lunes');
        $martes=$request->get( 'martes');
        $miercoles=$request->get( 'miercoles');
        $jueves=$request->get( 'jueves');
        $viernes=$request->get( 'viernes');
        $sabado=$request->get( 'sabado');
        $domingo=$request->get( 'domingo');
        if ($lunes==null & $martes==null & $miercoles==null & $jueves==null
        	 & $viernes==null& $sabado==null & $domingo==null) {
        	$dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
        }
        else{
        	$dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado'),$request->get('domingo')];
        }
        //dd($dias);
        $feriados = TipoFecha::lists('nombre_fecha')->ToArray();
        $ambiente=$request->get('ambiente_id');
        
        $periodos=$request->get('periodos');
        //fechas a reservar
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->get();
        //dd($fechas);
        

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
      
          return redirect()->action('DetalleReserva\DetalleReservaController@index',["idr"=>$id]);
    }
    
   public function edit($id)
    {
        $reserva=Reserva::findOrFail($id);
        
        $dreserva=DB::table('detalle_reservas as dr')
                            ->join('reservas as r','r.id','=','dr.reserva_id')
                            ->where('r.id',$id)
                            ->first();
        $fechaActual=Carbon::now();
        $horas=DB::table('detalle_reservas as dr')
                            ->join('reservas as r','r.id','=','dr.reserva_id')
                            ->join('periodos as p', 'p.id','=','dr.periodo_id')
                            ->where('r.id',$id)
                            ->select('p.id')
                            ->distinct()
                            ->lists('p.id')
                            ;

        // dd($horas);

        //dd($dreserva);
        $calendario=DB::table('calendarios')->get();
       // $dia=DB::table('dias')->get();
        $ambiente=DB::table('ambientes')->get();
        $user=DB::table('users')->get();
        $hora = Periodo::lists('hora','id');
        return view("reservas.edit",["reserva"=>$reserva,
            "calendario"=>$calendario,
           // "dia"=>$dia,
            "dreserva"=> $dreserva,
            "ambiente"=>$ambiente,
            "fechaActual"=>$fechaActual,
            "hora"=>$hora,
            "horas"=>$horas,
            "user"=>$user]);
    }

    
   public function update(Request $request, $id)
    {


        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('fecha_ini');
        $fecha_fin=$request->get('fecha_fin');
        $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];
        $fechas=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])->whereIn('Dia',$dias)
        ->get();
        $periodos=$request->get('periodos');
        $cantPer=count($periodos);
        //reservados
        $reservados=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
           
            ->lists('dr.id');


        $mireserva=DB::table('reservas as r')
                        ->join('detalle_reservas as dr','dr.reserva_id','=','r.id')
                        ->where('r.id',$id)
                        ->select('dr.id')
                      
                        ->lists('dr.id')
                        ;
        $contador=0;
        foreach ($reservados as $reser ) {
            
            if(!in_array($reser, $mireserva)){
                $contador++;
            
            }
            
        }
        if($contador>0){

            Flash::error("No se pudo crear la reserva,porque existen ". $contador ." conflicos con otras reservas ");
                return back();
        }else{

           
            $reservaUpdate=Reserva::find($id);
            $reservaUpdate->nombre_reseva=$request->get('nombre_reserva');
            $reservaUpdate->description=$request->get('description');
            $reservaUpdate->start=$fecha_ini;
            $reservaUpdate->end=$fecha_fin;
            $reservaUpdate->save();

            $detalles=DB:: table('detalle_reservas as dr')
                    ->where('dr.reserva_id',$id)
                    ->get();
       
            foreach ($detalles as $det ) {
                $detelleReserva= DetalleReserva::find($det->id);
                $detelleReserva->delete();
            }

            foreach ($fechas as $fc) {
                for ($i=0; $i < $cantPer; $i++) { 
                    $detres=new DetalleReserva;
                    $detres->estado="Activo";
                    $detres->reserva_id=$reservaUpdate->id;
                    $detres->calendario_id=$fc->id;
                    $detres->ambiente_id=$ambiente;
                    $detres->periodo_id=$periodos[$i];
                    $detres->save();
                }

                
            }

            Flash::success("La reserva se edito con exito");

            return Redirect::to('reservas');




        }




    }

    
    public function destroy($id)
    {
       $reserva=Reserva::find($id);
      
       $detalles=DB:: table('detalle_reservas as dr')
                    ->where('dr.reserva_id',$id)
                    ->get();
       
        foreach ($detalles as $det ) {
            $detelleReserva= DetalleReserva::find($det->id);
            $detelleReserva->delete();
        }
        $reserva->delete();
        Flash::warning("La Reserva ha sido eliminada");
        return Redirect::to('reservas');
    }
}