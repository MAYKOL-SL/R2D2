<?php

namespace Reserva\Http\Controllers\Complementos;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\Complemento;
use Session;
use Illuminate\Support\Facades\Redirect;
use Reserva\Http\Requests\ComponenteRequest;
use Laracasts\Flash\Flash;

class ComplementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complemento = Complemento::orderBy('id','ASC')->paginate(10);
        return view ('VistaComplemento.index',compact('complemento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('VistaComplemento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComponenteRequest $request)
    {
        $complemento = new Complemento($request -> all());
        $complemento->save();
        Flash::success("Se ha creado el complemento " . $complemento->nombre_complemento . " de forma correcta");
        return redirect()->route('complemento.index');
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
        $complemento = Complemento::find($id);

        return view('VistaComplemento.edit')->with('complemento',$complemento);
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
        $complemento = Complemento::find($id);
        $complemento->fill($request->all());
        $complemento->save();

        Flash::warning("El complemento " . $complemento->nombre_complemento . " ha sido editado con exito!");
        return redirect()->route('complemento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complemento = Complemento::find($id);
        $complemento->delete();

        Flash::error('El complemento '. $complemento->nombre_complemento . ' ha sido eliminado con exito!');
        return redirect()->route('complemento.index');
    }
}
