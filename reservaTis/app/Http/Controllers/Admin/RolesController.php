<?php

namespace Reserva\Http\Controllers\Admin;

use Reserva\Http\Requests;
use Reserva\Http\Controllers\Controller;

use Reserva\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

use Reserva\Permission;


class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

        $roles = Role::get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['name' => 'required', 'display_name' => 'required', ]);

        $roles = Role::create($request->all());
         $roles->save();


        Session::flash('flash_message1', 'Role  '.$roles->id.' Añadido!');

        return redirect('admin/roles');
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
        $role = Role::findOrFail($id);

        return view('admin.roles.show', compact('role'));
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
        $role = Role::findOrFail($id);

        /*$permission_role = Role::find($id)->permissions()->lists('permission_id')->toArray();

        $permissions = Permission::lists('display_name', 'id');*/

        return view('admin.roles.edit', compact('role'));


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

        $role = Role::findOrFail($id);
        $role->update($request->all());


        /*if($role->permissions->count()) {

               $role->permissions()->detach($role->permissions()->lists('permission_id')->toArray());
            }*/

        //$role->attachPermissions($request->input('permission_id'));

        Session::flash('flash_message2', 'Role  '.$role->id.' Actualizado!');

        return redirect('admin/roles');







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
        Role::destroy($id);

        Session::flash('flash_message3', 'Role  '.$id.' Eliminado!');

        return redirect('admin/roles');
    }

}
