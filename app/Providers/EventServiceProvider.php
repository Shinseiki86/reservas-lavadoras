<?php

namespace LAVA\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use LAVA\Models\Contrato;
use LAVA\Models\PeriodoNomina;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*'LAVA\Events\EventNewContrato' => [
            'LAVA\Listeners\CreateUserEmpleadoListener',
        ],*/
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        /**
         * Al crear un contrato, se crea un usuario con rol EMPLEADO
         * Por una regla del negocio se decidió no darle autonomía al empleado para sus certificados laborales
        **/
        /*Contrato::created(function($contrato){
            event(new \LAVA\Events\EventNewContrato($contrato));
        });*/

        /**
         * Cuando se realice el cierre de un periodo de nómina, se debe realizar el cierre 
         * (actualización de estado) de todas las novedades de nómina que tengan asociado 
         * el periodo a cerrar y el estado de los ausentismos (iniciales y prorrogas).
        **/
    }
}
