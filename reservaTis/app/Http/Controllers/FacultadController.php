<?php

namespace Reserva\Http\Controllers;

use Illuminate\Http\Request;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;
use Reserva\Facultad;
use Laracasts\Flash\Flash;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultades = Facultad::where('nombref','<>','complemento')->get();
        //return view('CrearFacultad.facuindex',["reservas"=>$datos]);
        return view('CrearFacultad.facuindex',["facultades"=>$facultades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CrearFacultad.createfacu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
      $facultad = new Facultad($request->all());
       $facultad->save();
      Flash::success("Facultad " . $facultad->nombref . " Añadido!! ");

       return redirect('facultad');
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
      $facultad = Facultad::findOrFail($id);

        return view('CrearFacultad.facuedit', compact('facultad'));
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
       $facultad = Facultad::findOrFail($id);
       $facultad->update($request->all());

       $facultad->save();

      Flash::warning("Facultad " . $facultad->nombref . " Actualizado!");

      return redirect('facultad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $facultadelim = Facultad::find($id);
      $facultadelim->delete();

      Flash::error('Facultad '. $facultadelim->nombref . ' Eliminado!');
      return redirect('facultad');
    }
}
