<?php

namespace Reserva\Http\Controllers\Admin;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Reserva\Permission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    
    
    public function index()
    {
        $permissions = Permission::paginate(15);

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'display_name' => 'required', ]);

        $permissions=Permission::create($request->all());

        

        Session::flash('flash_message1', 'Permisos  '.$permissions->id.' Añadido!');

        return redirect('admin/permissions');
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
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.show', compact('permission'));
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
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
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
        $this->validate($request, ['name' => 'required', 'display_name' => 'required', ]);

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        Session::flash('flash_message2', 'Permisos  '.$permission->id.' Actualizado!');

        return redirect('admin/permissions');
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
       $permission= Permission::destroy($id);

        Session::flash('flash_message3', 'Permisos  '.$id.' Eliminado!');

        return redirect('admin/permissions');
    }

}
