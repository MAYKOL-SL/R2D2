<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Reserva\Reserva;
use Reserva\DetalleReserva;
use Reserva\Ambiente;
use Carbon\Carbon;
use Reserva\Periodo;
use Reserva\DetalleGeneral;
use Reserva\Complemento;
use Reserva\TipoAmbiente;
use Laracasts\Flash\Flash;
use DB;

class PorHoraController extends Controller
{

    public function index(Request $request)
    {   
        if($request)
        {
            //datos necesarios
            $periodos = Periodo::lists('hora','id');
            $fechaActual=Carbon::now();
            $fechaActual=$fechaActual->addDay(1);
            $complement=DB::table('complementos')->select('nombre_complemento','id')->lists('nombre_complemento','id');
            $tiposAmbientes=TipoAmbiente::where('tipo_aula','!=','activo','and','tipo_aula','!=','inactivo')->lists('id');
            $ambientes=DB::table('ambientes as a')->join('tipo_ambientes as tp','tp.id','=','a.tipo_ambiente_id')
            ->whereIn('a.tipo_ambiente_id',$tiposAmbientes)
            ->select('a.title','a.id')->lists('title','id');
            $dias;
            //dd($complement);

            //request
            $complementos=$request->get('complementos');
            $fechaIni=$request->get('fechaIni');
            $fechaFin=$request->get('fechaFin');
            $capacidad=$request->get('capacidad');
            $perBuscados=$request->get('periodos');//para llenar datos
            $lunes=$request->get( 'lunes');
            $martes=$request->get('martes');
            $miercoles=$request->get('miercoles');
            $jueves=$request->get('jueves');
            $viernes=$request->get('viernes');
            $sabado=$request->get('sabado');
            $ambBuscado=$request->get('ambientes');
            //dd($ambBuscado);
            $verificador = false;
            if ($complementos==null && $fechaIni==null && $fechaFin==null && $capacidad==null && $perBuscados==null && $ambBuscado==null) {
                $verificador = true;
            }



            //controles de error
            //fecha
            if ($fechaIni == null && $fechaFin == null) {
                $fechaIni=$fechaActual;
                $fechaFin=$fechaActual;
            }
            //capacidad no sea nulo
            if ($capacidad == null) {
                $capacidad = 1;
            }
            //dd($capacidad);
            //dias no sean nulos
            
            if ($lunes==null & $martes==null & $miercoles==null & $jueves==null
             & $viernes==null& $sabado==null) {
                $dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
            }
            else{
                $dias=[$request->get( 'lunes'),$request->get('martes'),$request->get('miercoles'),
                $request->get('jueves'),$request->get('viernes'),$request->get('sabado')];
            }
            //dd($dias);

            //Busqueda Listas y Objetos

            //Listas
            //Ambieentes con capacidad buscada(parece array)
            $listAmb;
            if ($ambBuscado == null ) {
                if ($complementos == null) {
                $listAmb=DB::table('ambientes as a')
                ->join('tipo_ambientes as tp','tp.id','=','a.tipo_ambiente_id')
                ->whereIn('a.tipo_ambiente_id',$tiposAmbientes)
                ->where('a.capacidad','>=',$capacidad)
                ->orderBy('a.capacidad')
                ->select('a.title','a.id')
                ->lists('a.id');
                //dd($listAmb);
                }
                else{
                    $listAmb=DB::table('ambientes as a')
                    ->join('tipo_ambientes as tp','tp.id','=','a.tipo_ambiente_id')
                    ->whereIn('a.tipo_ambiente_id',$tiposAmbientes)
                    ->where('a.capacidad','>=',$capacidad)
                    ->join('ambiente_complemento as ac','ac.ambiente_id','=','a.id')
                    ->whereIn('ac.complemento_id',$complementos)
                    ->orderBy('a.capacidad')
                    ->select('a.title','a.id')
                    ->lists('a.id');
                    //dd($listAmb);
                }
            }
            else{
                if ($complementos == null) {
                $listAmb=DB::table('ambientes as a')->join('tipo_ambientes as tp','tp.id','=','a.tipo_ambiente_id')
                ->whereIn('a.tipo_ambiente_id',$tiposAmbientes)
                ->whereIn('a.id',$ambBuscado)
                ->where('capacidad','>=',$capacidad)
                ->orderBy('a.capacidad')
                ->select('a.title','a.id')
                ->lists('a.id');
                //dd($listAmb);
                }
                else{
                    $listAmb=DB::table('ambientes as a')->join('tipo_ambientes as tp','tp.id','=','a.tipo_ambiente_id')
                    ->whereIn('a.tipo_ambiente_id',$tiposAmbientes)
                    ->whereIn('a.id',$ambBuscado)
                    ->where('a.capacidad','>=',$capacidad)
                    ->join('ambiente_complemento as ac','ac.ambiente_id','=','a.id')
                    ->whereIn('ac.complemento_id',$complementos)
                    ->orderBy('a.capacidad')
                    ->select('a.title','a.id')
                    ->lists('a.id');
                    //dd($listAmb);
                }
            }




            

            //rango de fechas
            $listFechas=DB::table('calendarios')
            ->whereBetween('Fecha',[$fechaIni,$fechaFin])
            ->whereIn('Dia',$dias)
            ->select('Fecha','id')
            ->orderBy('id')
            ->lists('id');
            //dd(count($listFechas));

            //generando horarios y fechas disponibles de un ambiente
            $detalles=array();//todos los espacios libres
            //dd($detalles);
            for ($cAmb=0; $cAmb < count($listAmb); $cAmb++) { 
                for ($cFc=0; $cFc < count($listFechas); $cFc++) { 
                    for ($cPer=0; $cPer < count($perBuscados); $cPer++) {
                        //dd($listAmb[$cAmb]);
                        //dd($listFechas[$cFc]);
                        //dd($perBuscados[$cPer]);

                        //$feriados=
                        $Amb=DB::table('ambientes')
                        //->join('ambiente_complemento as ac','ac.ambiente_id','=','a.id')
                        //->whereIn('ac.complemento_id',$complementos)
                        ->where('id',$listAmb[$cAmb])
                        ->orderBy('capacidad')
                        ->select('id','title','capacidad')
                        ->get();
                        //dd($Amb[0]->id);
                        //rango de fechas
                        $fecha=DB::table('calendarios')
                        ->where('id',$listFechas[$cFc])
                        ->whereIn('Dia',$dias)
                        ->select('id','Fecha')
                        ->orderBy('id')
                        ->get();
                        //dd($fecha[0]->id);
                        //dd($detalles[$cDet]->calendario_id);
                        $Per=DB::table('periodos')
                        ->where('id',$perBuscados[$cPer])
                        ->select('id','hora')
                        ->get();
                        //dd($detalles[$cDet]->periodo_id);
                        //dd($listPer);


                        //reservado
                        $reservado=DB::table('detalle_reservas as dr')
                        ->where('dr.estado','activo')
                        ->join('ambientes as a','a.id','=','dr.ambiente_id')
                        ->where('a.id','=',$listAmb[$cAmb])
                        ->join('calendarios as c','c.id','=','dr.calendario_id')
                        ->where('c.id','=',$listFechas[$cFc])
                        ->join('periodos as p','p.id','=','dr.periodo_id')
                        ->where('p.id',$perBuscados[$cPer])
                        ->select('dr.id as id')
                        ->lists('id');
                        //dd(count($reservado));
                        if (count($reservado) < 1) {
                            $resauxiliar=new DetalleGeneral;
                            $resauxiliar->calendario_id=$fecha[0]->id;
                            $resauxiliar->fecha=$fecha[0]->Fecha;
                            $resauxiliar->ambiente_id=$Amb[0]->id;
                            $resauxiliar->title=$Amb[0]->title;
                            $resauxiliar->capacidad=$Amb[0]->capacidad;
                            $resauxiliar->periodo_id=$Per[0]->id;
                            $resauxiliar->hora=$Per[0]->hora;
                            array_push($detalles, $resauxiliar);
                            //dd($resauxiliar);
                        }
                        
                    }
                    //dd($detalles);
                }
            }//dd($detalles);
            if (count($detalles) == 0 && $verificador==false) {
                Flash::warning("no se encontraron coincidencias");
            }
            $comple=DB::table('complementos')->whereIn('id',$complementos)->select('nombre_complemento','id')->lists('id');
            $perBusc=Periodo::whereIn('id',$perBuscados)->lists('id')->ToArray();
            $ambBusc=Ambiente::whereIn('id',$ambBuscado)->lists('id')->ToArray();
            //dd($perBusc);



            return view('porHora.index',["ambientes"=>$ambientes,"capacidad"=>$capacidad,"perBuscados"=>$perBuscados,"comp"=>$complementos,"fechaActual"=>$fechaActual,"hora"=>$periodos,"complement"=>$complement,"libres"=>$detalles,"perBusc"=>$perBusc,"comple"=>$comple,"ambBusc"=>$ambBusc,"fechaIni"=>$fechaIni,"fechaFin"=>$fechaFin]);
        }

    }


    public function create()
    {
        //
    }


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
            Flash::success("Reserva Añadido!");
            return Redirect::to('reservas');
        }

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
      $fechaActual=Carbon::now();
      $calendario=DB::table('calendarios')->get();
     // $dia=DB::table('dias')->get();
      $ambiente=DB::table('ambientes')->get();
      $id_amb = Ambiente::find($id);
      $user=DB::table('users')->get();
      $hora = Periodo::lists('hora','id');
      return view("porHora.create",[
          "calendario"=>$calendario,
          "ambiente"=>$ambiente,
          "fechaActual"=>$fechaActual,
          "hora"=>$hora,
          "user"=>$user,
          "id_amb"=>$id_amb]);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        //
    }
}
