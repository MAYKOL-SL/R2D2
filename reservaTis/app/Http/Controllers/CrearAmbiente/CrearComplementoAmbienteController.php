<?php

namespace Reserva\Http\Controllers\CrearAmbiente;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Reserva\Ambiente;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Session;
use Reserva\Role;
use Reserva\Complemento;
use Reserva\Imagen;
use Reserva\TipoAmbiente;
use Reserva\AmbienteComplemento;
use Laracasts\Flash\Flash;
use DB;
class CrearComplementoAmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ambiente = Ambiente::search($request->name)->orderBy('title','ASC')->paginate(20);
        $ambiente->each(function($ambiente){
            $ambiente->complementos->lists('nombre_complemento')->ToArray();
            $ambiente->tipo_ambiente;

        });
        return view('CrearComplementoAmbiente.index' )
        ->with('ambiente',$ambiente);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $complementos = Complemento::orderBy('nombre_complemento','ASC')->lists('nombre_complemento','id');
        $tipos = TipoAmbiente::orderBy('tipo_aula','ASC')->where('tipo_aula','=','activo')->orwhere('tipo_aula','=','inactivo')->lists('tipo_aula','id');

        return view('CrearComplementoAmbiente.create',compact('complementos','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ambiente = new Ambiente($request->all());
        $ambiente->save();

       $ambiente->complementos()->sync($request->complementos);

       Flash::success("Complemento " . $ambiente->title . " Añadido! ");

        return redirect()->route('CrearAmbiente.index');
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
         $ambiente = Ambiente::find($id);
        $ambiente->tipo_ambiente;
        $complementos = Complemento::orderBy('nombre_complemento','ASC')->lists('nombre_complemento','id');
        $tipos = TipoAmbiente::orderBy('tipo_aula','ASC')->where('tipo_aula','=','activo')->orwhere('tipo_aula','=','inactivo')->lists('tipo_aula','id');

        $my_complementos = $ambiente->complementos->lists('id')->ToArray();

        return view('CrearComplementoAmbiente.edit')
        ->with('complementos',$complementos)
        ->with('ambiente',$ambiente)
        ->with('tipos',$tipos)
        ->with('my_complementos', $my_complementos);
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
         $ambiente = Ambiente::find($id);
        $ambiente->fill($request->all());
        $ambiente->save();

        $ambiente->complementos()->sync($request->complementos);

        Flash::warning("Complemento " . $ambiente->title . " Actualizado!");
        return redirect()->route('CrearAmbiente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambiente = Ambiente::find($id);
        $ambiente->delete();

        Flash::error('Complemento '. $ambiente->title . ' Eliminado!');
        return redirect()->route('CrearAmbiente.index');
    }
}
