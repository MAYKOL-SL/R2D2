<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
//use Reserva\Http\Requests\ReservadoFormRequest;
use Reserva\Reserva;
use DB;
//use User;
class ReservasController extends Controller
{
    
    public function index(Request $request)
    {
        if($request)
        {
            $datos=DB::table('reservas as r')
            ->join('ambientes as a','a.id','=','r.ambiente_id')
            ->join('users as u','u.id','=','r.user_id')
            ->join('dias','dias.id','=','r.dia_id')
            ->join('periodos as p','p.id','=','dias.periodo_id')
            ->where('u.id','=','1')
            ->select('r.id as id_reserva','u.name as usuario','a.nombre_aula',
                    'dias.nombre_dia','dias.fecha_dia','p.hora_inicio','p.hora_fin')
            ->paginate(5);
            return view('reservas.index',["reservas"=>$datos]);
        }
    }

    
    public function create()
    {
        $ambiente=DB::table('ambientes')->get();
        $dia=DB::table('dias')->get();
        $calendario=DB::table('calendarios')->get();
        $user=DB::table('users')->get();
        return view("reservas.create",["calendario"=>$calendario,"dia"=>$dia,"ambiente"=>$ambiente,"user"=>$user]);
    }

    
    public function store(Request $request)
    {

        $reserva=new Reserva;
        $reserva->calendario_id=$request->get('calendario_id');
        $reserva->dia_id=$request->get('dia_id');
        $reserva->ambiente_id=$request->get('ambiente_id');
        $reserva->user_id=$request->get('user_id');
        $reserva->save();
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
