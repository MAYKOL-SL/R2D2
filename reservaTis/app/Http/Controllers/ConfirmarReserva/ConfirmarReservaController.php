<?php

namespace Reserva\Http\Controllers\ConfirmarReserva;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Reserva\Reserva;
use Reserva\DetalleReserva;
use Reserva\Periodo;
use Reserva\Calendario;
use DB;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
class ConfirmarReservaController extends Controller
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
                            ->select('r.id as id_reserva','us.name as usuario','amb.title as nombre_aula','r.nombre_reseva as nombre_reserva','r.description','r.start','r.end','cal.Fecha','periodos.hora','dr.id as id_detalle','dr.estado','cal.Dia')

                            ->where('dr.reserva_id','=',$idreserva)
                            ->orderBy('cal.Fecha')
                           /////// ->where('dr.estado','=','activo')///////
                            //->distinct()
                            ->get();


            $ambiente=$request->get('ambiente');

            $fecha_ini=$request->get('fecha_ini');
            $fecha_fin=$request->get('fecha_fin');
            $dias=$request->get('dias');
            $periodos=$request->get('periodos');

///////////////////////////////////////////////////////////
                            // $conflictos=DB::table('detalle_reservas as dr')
                            // ->join('reservas as r','r.id','=','dr.reserva_id')
                            // ->where('r.id',$idreserva)
                            // ->join('users as u','u.id','=','r.user_id')
                            // ->join('ambientes as a','a.id','=','dr.ambiente_id')
                            // ->join('calendarios as c','c.id','=','dr.calendario_id')
                            // ->join('periodos as p','p.id','=','dr.periodo_id')
                            // ->where('dr.estado','=','inactivo')
                            // ->select('dr.reserva_id as conflicto_id','dr.id as dconflicto_id','u.name','a.title','p.hora as horaconflicto','c.Fecha as Fconflicto')
                            // ->get();
            //////////////////////////////////////////////////////////////
/*
                            $conflictos=DB::table('detalle_reservas as dr')
                            ->join('reservas as r','r.id','=','dr.reserva_id')
                            ->join('users as u','u.id','=','r.user_id')
                            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
                            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
                            ->whereIn('c.Dia',$dias)
                            ->join('periodos as p','p.id','=','dr.periodo_id')
                            ->whereIn('p.id',$periodos)
                            ->where('dr.estado','=','inactivo')
                            ->select('dr.reserva_id as conflicto_id','dr.id as dconflicto_id','u.name','a.title','p.hora as horaconflicto','c.Fecha as Fconflicto')
                            ->get();
                            */



            //dd($conflictos,$datosListado,$datosDetalle,$idreserva);



           // return view('ConfirmarReserva.index',["reservas"=>$datosListado,"conflictos"=>$conflictos,"id_reserva"=>$idreserva]);
            return view('ConfirmarReserva.index',["reservas"=>$datosListado,"id_reserva"=>$idreserva]);

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
    public function store($id)
    {
        //

        $reserva=Reserva::find($id);

        $detalles=DB:: table('detalle_reservas as dr')
                    ->where('dr.reserva_id',$id)
                    ->where('dr.estado','libre')
                    ->get();

        if(empty($detalles)){

            Flash::error("Reserva ocupada");
        }else{
            foreach ($detalles as $det ) {
                $detalleReserva= DetalleReserva::find($det->id);
                $detalleReserva->estado='activo';
                $detalleReserva->save();
              }

            $reserva->estado='activo';
            $reserva->save();
            Flash::success("Reserva Añadido!");

        }


        
        return Redirect::to('reservas');

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
        // dd($id);
       $dreserva=DetalleReserva::find($id);

       // dd($dreserva);
       /*
       $dreserva=DB::table('detalle_reservas as dr')
                            ->join('reservas as r','r.id','=','dr.reserva_id')
                            ->where('r.id',$id)
                            ->first();
                            */
        //dd($dreserva);
        $horas=DB::table('detalle_reservas as dr')
                            ->join('periodos as p', 'p.id','=','dr.periodo_id')
                            ->where('dr.id',$id)
                            ->select('p.id')
                            ->distinct()
                            ->lists('p.id');
         //dd($detalle->calendario_id);
        $fechaSel=Calendario::findOrFail($dreserva->calendario_id);
        //dd($fechaSel->Fecha);
        //por defecto
        $fechaActual=Carbon::now();
        $fechaActual=$fechaActual->addDay(1);
        $ambiente=DB::table('ambientes')->get();
        $calendario=DB::table('calendarios')->get();
        $hora = Periodo::lists('hora','id');
        return view("ConfirmarReserva.edit",[//"detalle"=>$detalle,
            "fechaSel"=>$fechaSel,
            "horas"=>$horas,
            "dreserva"=>$dreserva,
            "calendario"=>$calendario,
            "ambiente"=>$ambiente,
            "fechaActual"=>$fechaActual,
            "hora"=>$hora]);
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

        //dd($dreserva->reserva_id);
        $fechares=DB::table('calendarios')->where('Fecha',$request->get('fecha'))->get();
        //dd($fechares);
        $fecha=$request->get('fecha');
        $dreserva=DetalleReserva::find($id);

        $hora=$request->get('periodos');
        //dd($fecha);

        $reserva=Reserva::find($dreserva->reserva_id);
        //importante
        $idr=$reserva->id;
        //basura
        $ambiente=$dreserva->ambiente_id;
        $fecha_ini=$reserva->start;
        $fecha_fin=$reserva->end;
        $dias;
        $periodos;

        $reservados=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')
            ->where('a.id',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')
            ->where('c.Fecha',$fecha)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->where('p.id',$hora)
            ->lists('c.Fecha');
        //dd($reservados);
        //actualizando
            if (count($reservados)>0) {
                Flash::warning("No es posible hacer esta reserva");
                return  redirect()->action('ConfirmarReserva\ConfirmarReservaController@index',compact('idr','ambiente','fecha_ini','fecha_fin','dias','periodos'));
            }
            else{
                foreach ($fechares as $fc) {
                $detalle=DetalleReserva::find($id);
                $detalle->estado='libre';
                $detalle->reserva_id=$detalle->reserva_id;
                $detalle->calendario_id=$fc->id;
                $detalle->periodo_id=$request->get('periodos');
                $detalle->ambiente_id=$request->get('ambiente_id');
                $detalle->save();
                }
                Flash::success("Reserva  Actualizada");
                return  redirect()->action('ConfirmarReserva\ConfirmarReservaController@index',compact('idr','ambiente','fecha_ini','fecha_fin','dias','periodos'));
            }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        //dd($id);

        $reserva=Reserva::find($id);

       $detalles=DB:: table('detalle_reservas as dr')
                    ->where('dr.reserva_id',$id)
                    ->get();

        foreach ($detalles as $det ) {
            $detalleReserva= DetalleReserva::find($det->id);
            $detalleReserva->delete();
        }
        $reserva->delete();
        Flash::warning("Reserva Eliminada");
        return Redirect::to('reservas');

    }
}
