<?php
namespace etm\etm_permisos;

use Illuminate\Support\ServiceProvider;

class etmPermisosServiceProvider extends ServiceProvider
{
 public function register() {
     //en caso de no funcionar las rutas ingresar "php artisan config:clear" en la terminal
    $this->mergeConfigFrom(

        __DIR__.'/../config/etm_permisos.php','etm_permisos'

    );
 }


// todo lo que se publica se pasa al proyecto en laravel 



 public function boot(){
     //cargar datos de las migraciones

    $this->loadMigrationsFrom([
         __DIR__.'/../database/migrations'
    
    ]);


    //publicar nuestras migraciones

    $this->publishes([
        __DIR__.'/../database/migrations' =>
        database_path('migrations')
   
    ],'etmPermisos-migrations');



    //publicar nuestras seed, luego de ejecutar los seed se debe de realizar un composer dump
    $this->publishes([
        __DIR__.'/../database/seeders' =>
        database_path('seeders')
   
    ],'etmPermisos-seeders');



       //publicar politicas y gates

       $this->publishes([
        __DIR__.'/../Policies' =>
        app_path('Policies')
   
    ],'etmPermisos-policies');

  // cargar rutas
    $this->loadRoutesFrom(
        __DIR__.'/../routes/web.php' 
   );


  //cargar vistas agrregamos un namespace por que se pueden llefar a tener dos vistas con el mismo nombre en el proyecto y en el paquete
  $this->loadViewsFrom(
    __DIR__.'/../resources/views','etm_permisos' 
);



       //publicar vistas se deben meter en la carpeta vendor y acceder por el namespace

       $this->publishes([
        __DIR__.'/../resources/views' =>
        resource_path('views/vendor/etm_permisos')
   
    ],'etmPermisos-views');


     //publicar config 

     $this->publishes([
        __DIR__.'/../config/etm_permisos.php' =>
        config_path('etm_permisos.php')
   
    ],'etmPermisos-config');


 }

}



