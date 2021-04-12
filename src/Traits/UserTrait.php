<?php

namespace etm\etm_permisos\Traits;

trait UserTrait{

    public function roles()
    {
        return $this->belongsToMany('etm\etm_permisos\Models\Role')->withTimesTamps();
    }

    //blindar
    // un ususario puede tener mas de un rol
    //return $this->roles;--------------------función para todos los modelos 
    public function havePermission($permission)
    {
        foreach ($this->roles as $role)
        {
            if($role['full-access'] =='yes')
            {
                return true;
            }
            foreach ($role->permissions as $perm){

                if($perm->slug == $permission)
                {
                    return true;
                }
            }


        }
        return false;
       
    }

}


