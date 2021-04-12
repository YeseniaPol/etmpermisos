<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use etm\etm_permisos\Models\Role;
use etm\etm_permisos\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; //truncate para vaciar la bd y volverl id en cero

class ETMPermissionInfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //primer usuario
    {

        //eleaboramos el truncate de las tablas
      /*  DB ::statement('SET FOREIGN_KEY_CHECKS = 0;');
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB ::statement('SET FOREIGN_KEY_CHECKS = 1;');
//ACTIVAMOS LOS FOREIGN_KEY
//DESACTIVAMOS LOS FOREIGN_KEY

*/

        //user admin
        $useradmin= User::where('email','admin@admin.com')->first();  //elimina el ususrio cuando lo encuentre 
        if($useradmin) {
            $useradmin->delete();
        }

        //agrega de nuevo el usuario
        $useradmin= User::create ([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')

        ]);

       
        //rol admin
       $roladmin=Role::create([
            'name'=>'Admin',
            'slug'=>'admin',
            'description'=>'administrator',
            'full-access'=>'yes',
        ]);



        //--- crear para el listeners

        $roluser=Role::create([
            'name'=>'Registered User',
            'slug'=>'Registereduser',
            'description'=>'Registered User',
            'full-access'=>'no',
        ]);



        //---------



       // table role_user
       $useradmin->roles()->sync([ $roladmin->id ]); 
        //relación de dos tablas 

       // $useradmin->roles()->sync([ 1]); 


        $permission_all = [];


        //permisos de roles
        $permission = Permission::create([
            'name'=>'List role',
            'slug'=>'role.index',
            'description'=>'list roles',
        ]);
            
        $permission_all [] = $permission->id;
                

        //permisos de roles
        $permission = Permission::create([
            'name'=>'Show role',
            'slug'=>'role.show',
            'description'=>'see roles',
        ]);
            
        $permission_all [] = $permission->id;
                
            //permisos de roles
        $permission = Permission::create([
            'name'=>'Create role',
            'slug'=>'role.create',
            'description'=>'create roles',
        ]);
            
        $permission_all [] = $permission->id;
                

        //permisos de roles
        $permission = Permission::create([
            'name'=>'Edit role',
            'slug'=>'role.edit',
            'description'=>'edit roles',
        ]);
            
        $permission_all [] = $permission->id;
                

            //permisos de roles
        $permission = Permission::create([
            'name'=>'Destroy role',
            'slug'=>'role.destroy',
            'description'=>'destroy roles',
        ]);
            
        $permission_all [] = $permission->id;
          


        //table permission
      //  $roladmin->permissions()->sync([ $permission_all]); 






                //permisos de user
        $permission = Permission::create([
            'name'=>'List user',
            'slug'=>'user.index',
            'description'=>'list user',
        ]);
            
        $permission_all [] = $permission->id;
                

        //permisos de user
        $permission = Permission::create([
            'name'=>'Show user',
            'slug'=>'user.show',
            'description'=>'see user',
        ]);
            
        $permission_all [] = $permission->id;
                
            //permisos de user se utiliza siempre que no se tenga la opcion de registrar al inicio del Login
        /*$permission = Permission::create([
            'name'=>'Create user',
            'slug'=>'user.create',
            'description'=>'create user',
        ]);
            
        $permission_all [] = $permission->id;
        */        

        //permisos de user
        $permission = Permission::create([
            'name'=>'Edit user',
            'slug'=>'user.edit',
            'description'=>'edit user',
        ]);
            
        $permission_all [] = $permission->id;
                

            //permisos de user
        $permission = Permission::create([
            'name'=>'Destroy user',
            'slug'=>'user.destroy',
            'description'=>'destroy user',
        ]);
            
        $permission_all [] = $permission->id;
                

         //table permission
        // $roladmin->permissions()->sync([ $permission_all]); 








        
         

//----------------------------------------------------policy

        $permission = Permission::create([
            'name'=>'Show own user',
            'slug'=>'userown.show',
            'description'=>'see  own user',
        ]);
            
        $permission_all [] = $permission->id;
            

        $permission = Permission::create([
            'name'=>'Edit own user',
            'slug'=>'userown.edit',
            'description'=>'edit own user',
        ]);
            
            
            
    }



}
