<?php

namespace LAVA\Jobs;

use Illuminate\Bus\Queueable;

abstract class Job
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "onQueue" and "delay" queue helper methods.
    |
    */

    use Queueable;


    private function logError($msg){
        env('QUEUE_DRIVER')=='database' ?
            Log::error( $msg.'  ->  '.$e ) :
            flash_alert( $msg, 'danger' );
    }
}
