<?php

namespace Reserva\Http\Controllers\CrearAmbiente;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Reserva\Ambiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Session;
use Reserva\Role;
use Reserva\Complemento;
use Reserva\TipoAmbiente;
use Reserva\AmbienteComplemento;
use Laracasts\Flash\Flash;
use DB;


class CrearAmbienteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    
   
    public function index(Request $request)
    {

        $ambiente = Ambiente::search($request->name)->orderBy('id','ASC')->paginate(10);
        $ambiente->each(function($ambiente){
            $ambiente->complementos;
;            $ambiente->tipo_ambiente;
        });
        return view('CrearAmbiente.index')->with('ambiente',$ambiente);
        /*$ambiente = Ambiente::select('title','capacidad','ubicacion','tipo_ambientes.tipo_aula as tipo_aula')
        ->join('tipo_ambientes','tipo_ambientes.id','=','ambientes.tipo_ambiente_id')
        ->get();
        return view('CrearAmbiente.index',compact('ambiente'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $complementos = Complemento::orderBy('nombre_complemento','ASC')->lists('nombre_complemento','id'); 
        $tipos = TipoAmbiente::orderBy('tipo_aula','ASC')->lists('tipo_aula','id');

        return view('CrearAmbiente.create', compact('complementos','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

       $ambiente = new Ambiente($request->all());
       $ambiente->save();

       $ambiente->complementos()->sync($request->complementos);

       Flash::success("Se a creado el " . $ambiente->title . " correctamente!! ");

        return redirect()->route('CrearAmbiente.index');

   }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ambiente = Ambiente::find($id);
        $ambiente->tipo_ambiente;
        $complementos = Complemento::orderBy('nombre_complemento','ASC')->lists('nombre_complemento','id');
        $tipos = TipoAmbiente::orderBy('tipo_aula','ASC')->lists('tipo_aula','id');

        $my_complementos = $ambiente->complementos->lists('id')->ToArray();

        return view('CrearAmbiente.edit')
        ->with('complementos',$complementos)
        ->with('ambiente',$ambiente)
        ->with('tipos',$tipos)
        ->with('my_complementos', $my_complementos);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
    
        $ambiente = Ambiente::find($id);
        $ambiente->fill($request->all());
        $ambiente->save();

        $ambiente->complementos()->sync($request->complementos);

        Flash::warning("El ambiente " . $ambiente->title . " ha sido editado con exito!");
        return redirect()->route('CrearAmbiente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ambiente = Ambiente::find($id);
        $ambiente->delete();

        Flash::error('El ambiente '. $ambiente->title . ' ha sido eliminado con exito!');
        return redirect()->route('CrearAmbiente.index');
    }

    
}
