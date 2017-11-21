<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\TipoAmbiente;
use Carbon\Carbon;
use Reserva\Periodo;
use Reserva\Ambiente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Reserva\Reserva;
use Reserva\DetalleReserva;
use Laracasts\Flash\Flash;
use Reserva\TipoFecha;

use DB;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ambiente = Ambiente::search($request->name)->orderBy('title','ASC')->paginate(10);
        $ambiente->each(function($ambiente){
            $ambiente->complementos->lists('nombre_complemento')->ToArray();
            $ambiente->tipo_ambiente;

        });
        return view('porAmbiente.index')
        ->with('ambiente',$ambiente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //datos recogidos
        $ambiente=$request->get('ambiente_id');
        $fecha_ini=$request->get('fecha_ini');
        $fecha_fin=$request->get('fecha_fin');
        $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];

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

        $listaFechasDisp=DB::table('calendarios')->whereBetween('Fecha',[$fecha_ini,$fecha_fin])
        ->whereIn('Dia',$dias)->whereNotIn('Fecha',$feriados)
        ->lists('calendarios.Fecha');
        //reservados
        $conflictos=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->select('dr.reserva_id as conflicto_id','dr.id as dconflicto_id','dr.periodo_id as pconflicto_id','c.Fecha as Fconflicto')
            ->get();



        $listaFechasConflic=DB::table('detalle_reservas as dr')->where('estado','=','activo')
            ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
            ->join('calendarios as c','c.id','=','dr.calendario_id')->whereBetween('c.Fecha',[$fecha_ini,$fecha_fin])
            ->whereIn('c.Dia',$dias)
            ->join('periodos as p','p.id','=','dr.periodo_id')
            ->whereIn('p.id',$periodos)
            ->lists('c.Fecha')
            ;


            $contador = array();
            foreach ($conflictos as $res ) {
                array_push($contador, $res->dconflicto_id);
            }

            $contador=count($contador);
            $cantPer=count($periodos);
            //dd($cantPer);


        //verificar
        if ($contador > 0) {
        ////////si existen conflictos se hace la reserva como inactivo///////////
            $reserva=new Reserva;
            $reserva->estado="inactivo";
            $reserva->nombre_reseva=$request->get('nombre_reserva');
            $reserva->description=$request->get('description');
            $reserva->start=$fecha_ini;
            $reserva->end=$fecha_fin;
            $reserva->user_id=$request->get('user_id');
            $reserva->save();
        /////fin creacion reserva como inactivo///
            foreach ($fechas as $fd) {
                ////si no existe la fechadisponible en la lista de fechas con conflicio entonces se crea la reserva como inactivo





                    for ($i=0; $i < $cantPer; $i++) {
                        $periodoConflic=DB::table('detalle_reservas as dr')->where('estado','=','activo')
                                    ->join('ambientes as a','a.id','=','dr.ambiente_id')->where('a.id','=',$ambiente)
                                    ->join('calendarios as c','c.id','=','dr.calendario_id')->where('c.Fecha',$fd->Fecha)
                                    ->whereIn('c.Dia',$dias)
                                    ->join('periodos as p','p.id','=','dr.periodo_id')
                                    ->where('p.id',$periodos[$i])
                                    ->lists('p.hora')
                                    ;


                        if(empty($periodoConflic)){

                            $detres=new DetalleReserva;
                            $detres->estado="inactivo";
                            $detres->reserva_id=$reserva->id;
                            $detres->calendario_id=$fd->id;
                            $detres->ambiente_id=$ambiente;
                            $detres->periodo_id=$periodos[$i];
                            $detres->save();
                        }


                    }




            }
            $idr=$reserva->id;

            //dd($fechas,$listaFechasConflic);
            Flash::warning("Su reserva tiene conflictos con otras reservas");

            return  redirect()->action('ConfirmarReserva\ConfirmarReservaController@index',compact('idr','ambiente','fecha_ini','fecha_fin','dias','periodos'));;

        }
        ///SI NO EXISTEN CONFLICTOS SE CREA LA RESERVA NORMAL COMO ACTIVO////
        else{
            //registro de reserva
            $reserva=new Reserva;
            $reserva->estado="activo";
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
                    $detres->estado="activo";
                    $detres->reserva_id=$reserva->id;
                    $detres->calendario_id=$fc->id;
                    $detres->ambiente_id=$ambiente;
                    $detres->periodo_id=$periodos[$i];
                    $detres->save();
                }


            }
            Flash::success("Se ha creado la reserva de forma correcta");
            return Redirect::to('reservas');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fechaActual=Carbon::now();
        $calendario=DB::table('calendarios')->get();
       // $dia=DB::table('dias')->get();
        $ambiente=DB::table('ambientes')->get();
        $id_amb = Ambiente::find($id);
        $user=DB::table('users')->get();
        $hora = Periodo::lists('hora','id');
        return view("porAmbiente.create",[
            "calendario"=>$calendario,
            "ambiente"=>$ambiente,
            "fechaActual"=>$fechaActual,
            "hora"=>$hora,
            "user"=>$user,
            "id_amb"=>$id_amb]);
        //return view('porAmbiente.create')->with('idambiente',$idambiente);
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
