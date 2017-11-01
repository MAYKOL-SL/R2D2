<?php

namespace Reserva\Http\Controllers\tipoDeAmbiente;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\TipoAmbiente;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class tipoDeAmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoambiente = TipoAmbiente::orderBy('id','ASC')->paginate(10);
        return view ('VistaTipoAmbiente.index',compact('tipoambiente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('VistaTipoAmbiente.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoambiente = new TipoAmbiente($request -> all());
        $tipoambiente->save();
        Flash::success("Se ha creado el tipo de ambiente: " . $tipoambiente->tipo_aula . " de forma correcta");
        return redirect()->route('tiposambiente.index');
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
        $tipoambiente = TipoAmbiente::find($id);

        return view('VistaTipoAmbiente.edit')->with('tipoambiente',$tipoambiente);
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
        $tipoambiente = TipoAmbiente::find($id);
        $tipoambiente->fill($request->all());
        $tipoambiente->save();

        Flash::warning("El tipo de aula: " . $tipoambiente->tipo_aula . " ha sido editado con exito!");
        return redirect()->route('tiposambiente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoambiente = TipoAmbiente::find($id);
        $tipoambiente->delete();

        Flash::error('El tipo de aula: '. $tipoambiente->tipo_aula . ' ha sido eliminado con exito!');
        return redirect()->route('tiposambiente.index');
    }
}
