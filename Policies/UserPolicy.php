<?php

//para que el administrador tenga permisos de edición en otros usuarios se debe modificar el seeder

namespace App\Policies;
//politica debe ser enlazada a un modelo 

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


     /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $usera
     * @return mixed
     */

    public function viewAny(User $usera)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $usera
     * @return mixed
     */
    public function create(User $usera)
    {
        return $usera->id > 0;
    }


    
  

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $usera
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $usera, User $user,  $perm=null)
    {
        
        if ($usera->havePermission($perm[0])){
            return true;
        }else  
        if ($usera->havePermission($perm[1])){
            return $usera->id === $user->id;
        }
        else {
            return false;
        }
    }






    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $usera
     * @param  \App\Models\User  $user
     * @return mixed
     */

// permisos de visualización
    public function view(User $usera, User $user, $perm=null) //0--user.show y 1=userown.show
    {

        if ($usera->havePermission($perm[0])){
            return true;
        }else  
        if ($usera->havePermission($perm[1])){
            return $usera->id === $user->id;
        }
        else {
            return false;
        }


        
    }



 
}
