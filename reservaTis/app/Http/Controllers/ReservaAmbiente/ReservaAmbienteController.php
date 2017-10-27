<?php

namespace Reserva\Http\Controllers\ReservaAmbiente;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Reserva\Ambiente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Reserva\Role;
use Reserva\Complemento;
use Reserva\TipoAmbiente;
use DB;


class ReservaAmbienteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    
   
    public function index()
    {


       

        $complementos = Complemento::lists('nombre_complemento','id'); 
        $tipos = TipoAmbiente::lists('tipo_aula','id');

        return view('ReservaAmbiente.create', compact('complementos','tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        // $roles = Role::orderBy('display_name', 'asc')->lists('display_name', 'id');

        // return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nombre' => 'required', 'capacidad' => 'required', 'ubicacion' => 'required', ]);

      // $ambiente = Ambiente::create($request->all());
       $ambiente=new Ambiente;
        $ambiente->title=$request->get('nombre');
        $ambiente->capacidad=$request->get('capacidad');
       $ambiente->ubicacion=$request->get('ubicacion');
       $ambiente->created_at='2017-10-25 17:05:35';
       $ambiente->updated_at='2017-10-25 17:05:35';
        $ambiente->tipo_ambiente_id=1;
        
       $ambiente->save();
      

        return redirect('ReservaAmbiente');
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
        
    }

    
}
