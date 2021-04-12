<?php

namespace etm\etm_permisos;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */



     //Politica implicada a user 
    protected $policies = [
         //'App\Models\Model' => 'App\Policies\ModelPolicy',
         User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */


    public function boot()
    {
        $this->registerPolicies();


//gate haveaccess
        Gate::define('haveaccess', function (User $user, $perm){
         //   dd($perm);
            //return true;
            return $user->havePermission($perm); 
            //return $perm;

        });


        //
    }
}
 