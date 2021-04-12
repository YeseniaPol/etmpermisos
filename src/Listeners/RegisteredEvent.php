<?php

namespace etm\etm_permisos\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisteredEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {

        //al ejecutar el evento llamamos rol 
        //aqui es donde se puede asociar un usuario a un rol (12)
        $event->user->roles()->sync([config('etm_permisos.IdRouteDefult')]);
    }
}
