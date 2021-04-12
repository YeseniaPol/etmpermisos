<?php

namespace etm\etm_permisos\Http\Controllers;

use App\Http\Controllers\Controller;
use etm\etm_permisos\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('haveaccess','user.index');//policy
        $users = User::orderBy('id','Desc')->simplePaginate(10);
        //return $users;
        return view('etm_permisos::user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', User::class);//solo para el metodo create
       //return 'Create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }



//--------------politicas

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', [$user, ['user.show','userown.show'] ]);//policy que es lo que quiero  en UserPolicy 0--user.show y 1=userown.show
       
        $roles= Role::orderBy('name')->get();

        //return $roles;

        return view('etm_permisos::user.view', compact('roles', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', [$user, ['user.edit','userown.edit'] ]);//policy

        $roles = Role::orderBy('name')->get();
       // return $roles;
        return view('etm_permisos::user.edit',compact('roles', 'user'));
    }




//--------------------------------


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        

        $request->validate([
            'name' =>'required|max:50|unique:users,name,'.$user->id, //tabla y campo con validación de registros si existen otros en la BD
            'email' =>'required|max:50|unique:users,email,'.$user->id,
        ]);
        //dd($request->all());

        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('user.index')
         ->with('status_success','User update sucessfully');
         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
 
        $this->authorize('haveaccess', 'user.destroy');

        $user->delete();

         return redirect()->route('user.index')
         ->with('status_success','User sucessfully removed');

    }


    


}
