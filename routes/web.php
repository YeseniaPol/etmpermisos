<?php

use Illuminate\Support\Facades\Route;

/*para incluir permisos se debe hacer uso de middleware*/
Route::resource(config('etm_permisos.RouteRole'), etm\etm_permisos\Http\Controllers\RoleController::class)->names('role')->middleware(['web']);

Route::resource(config('etm_permisos.RouteUser'), etm\etm_permisos\Http\Controllers\UserController::class,['except'=>['create','store']])->names('user')->middleware(['web']);//indica que no traera las funciones de create y store cuando el usuario pueda registrarse

//confing('etm_permisos.RouteRole')