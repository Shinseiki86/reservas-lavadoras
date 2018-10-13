<?php

namespace LAVA\Jobs;

use LAVA\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

use LAVA\Models\User;
use LAVA\Models\Prospecto;

class SendEmailClosedTicket extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $ticket;
    private $userCloses;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticket, $userCloses)
    {
        $this->ticket = $ticket;
        $this->userCloses = $userCloses;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ticket = $this->ticket;
        $userCloses = $this->userCloses;
        $view   = 'layouts.emails.info_ticket_cerrado';

        //if ($this->attempts() < 3) {
        try{
            Mail::send($view, compact('ticket'), function($message) use($ticket, $userCloses) {
                //Remitente
                $message->from(env('MAIL_USERNAME'), env('MAIL_NAME'));
                //Asunto
                $TICK_ID = str_pad($ticket->TICK_ID, 6, '0', STR_PAD_LEFT);
                $message->subject('Ticket '.$TICK_ID.' cerrado por G.H.');

                //usuario que creó el Ticket
                $to = [ $ticket->usuario->email, ];
                //usuario que cierra el Ticket
                $cc = [ $userCloses->email ];

                $responsableTemp = $ticket->contrato->temporal;

                /*
                //Si es temporal, entonces se envía correo al responsable de la temporal.
                if(isset($responsableTemp) and isset($responsableTemp->prospecto->PROS_CORREO))
                    $to[] = $responsableTemp->prospecto->PROS_CORREO;

                $responsableGH = $ticket->contrato->empleador;
                
                if(isset($responsableGH)){
                    //Si es directo, entonces se dirige al responsable de gestión humana del empleador
                    $to[] = $responsableGH->prospecto->PROS_CORREO;
                }
                */
                $prospecto = Prospecto::getJefe($ticket->usuario->cedula);  
                $prosJefe = Prospecto::findOrFail($prospecto->JEFE_ID);
                $jefe_email = $prosJefe->PROS_CORREO;

                $to[] = $jefe_email;

                $message->to($to);
                $message->cc($cc);
            });
        } catch(\Exception $e){
            $this->logError('Error enviando correo para ticket '.$ticket->TICK_ID.'. Error: '.$e->getMessage());
        }
    }
}
