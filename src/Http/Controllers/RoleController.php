<?php
namespace  etm\etm_permisos\Http\Controllers;

use App\Http\Controllers\Controller;
use etm\etm_permisos\Models\Role;
use etm\etm_permisos\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       Gate::authorize('haveaccess', 'role.index');

        $roles = Role::orderBy('id','Desc')->simplePaginate(10);

      //  return $roles;
        return view('etm_permisos::role.index', compact('roles'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        Gate::authorize('haveaccess', 'role.create');
        $permissions = Permission::get();
        return view('etm_permisos::role.create',compact('permissions'));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $request->validate([
            'name' =>'required|max:50|unique:roles,name', //tabla y campo
            'slug' =>'required|max:50|unique:roles,slug',
            'full-access' =>'required|in:yes,no'
        ]);

        $role = Role::create($request->all());
       // if($request->get('permission'))
       // {
        //return $request->all();
        $role->permissions()->sync($request->get('permission'));
        // }
         return redirect()->route('role.index')
         ->with('status_success','Role saved sucessfully');
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

        $this->authorize('haveaccess', 'role.show');
         //return $role;
         $permission_role=[];
         foreach($role->permissions as $permission )
     {
         $permission_role[]=$permission->id;
     }
         $permissions = Permission::get();
         return view('etm_permisos::role.view',compact('permissions','role','permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        $this->authorize('haveaccess', 'role.edit');
        //return $role;
        $permission_role=[];
        foreach($role->permissions as $permission )
    {
        $permission_role[]=$permission->id;
    }
        $permissions = Permission::get();
        return view('etm_permisos::role.edit',compact('permissions','role','permission_role'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('haveaccess', 'role.edit');


        $request->validate([
            'name' =>'required|max:50|unique:roles,name,'.$role->id, //tabla y campo con validación de registros si existen otros en la BD
            'slug' =>'required|max:50|unique:roles,slug,'.$role->id,
            'full-access' =>'required|in:yes,no'
        ]);

        $role->update($request->all());

     //   if($request->get('permission'))
       // {
        //return $request->all();
        $role->permissions()->sync($request->get('permission'));
       //  }
         return redirect()->route('role.index')
         ->with('status_success','Role update sucessfully');
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $this->authorize('haveaccess', 'role.destroy');

        $role->delete();

         return redirect()->route('role.index')
         ->with('status_success','Role sucessfully removed');

    }
}
