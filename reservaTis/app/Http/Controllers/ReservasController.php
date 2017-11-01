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
            ->paginate(5);
            return view('reservas.index',["reservas"=>$datos]);
        }
    }

    
    public function create()
    {
        $ambiente=DB::table('ambientes')->get();
        $calendarios=DB::table('calendarios')->get();
        $user=DB::table('users')->get();
        $periodo=DB::table('periodos')->get();
        $fechaActual=Carbon::now();
        $fechaActual=$fechaActual->addDay(1);
        return view("reservas.create",["calendario"=>$calendarios,"ambiente"=>$ambiente,"user"=>$user,"periodo_ini"=>$periodo, "periodo_fin"=>$periodo, "fechaActual"=>$fechaActual]);
    }

    
    public function store(Request $request)
    {

        $reserva=new Reserva;
        $reserva->nombre_reseva=$request->get('nombre_reserva');
        $reserva->description=$request->get('description');
        $reserva->start=$request->get('fecha_ini');
        $reserva->end=$request->get('fecha_fin');
        $reserva->user_id=$request->get('user_id');
        $reserva->save();
        //creado la reserva
        $detres=new DetalleReserva;
        $detres->reserva_id=$reserva->id;
        $detres->calendario_id='1';
        $detres->periodo_id=$request->get('periodo_id');
        $detres->ambiente_id=$request->get('ambiente_id');
        $detres->save();
        return Redirect::to('reservas');
    }

    
    public function show($id)
    {
        return view("reservas.show",["reservas"=>reservas::findOrFail($id)]);
    }

    
    public function edit($id)
    {
        $reserva=Reserva::findOrFail($id);
        $calendario=DB::table('calendarios')->get();
        $dia=DB::table('dias')->get();
        $ambiente=DB::table('calendarios')->get();
        $user=DB::table('users')->get();
        return view("reserva.edit",["reserva"=>$reserva,"calendario"=>$calendario,"dia"=>$dia,"ambiente"=>$ambiente,"user"=>$user]);
    }

    
    public function update(Request $request, $id)
    {
        $reserva=Reserva::findOrFail($id);
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
