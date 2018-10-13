<?php

namespace LAVA\Jobs;

use LAVA\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

use LAVA\Models\User;
use LAVA\Models\Prospecto;

class SendEmailAuthorizedTicket extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $ticket;
    private $userAuthorizes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticket, $userAuthorizes)
    {
        $this->ticket = $ticket;
        $this->userAuthorizes = $userAuthorizes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ticket = $this->ticket;
        $userAuthorizes   = $this->userAuthorizes;
        $view   = 'layouts.emails.info_ticket_autorizado';


        //if ($this->attempts() < 3) {
        try{
            Mail::send($view, compact('ticket'), function($message) use($ticket, $userAuthorizes) {
                //Remitente
                $message->from(env('MAIL_USERNAME'), env('MAIL_NAME'));
                //Asunto
                $TICK_ID = str_pad($ticket->TICK_ID, 6, '0', STR_PAD_LEFT);
                $message->subject('Ticket '.$TICK_ID.' autorizado');

                $to = [];
                //Copia al usuario que creó el ticket y al usuario que autorizó el ticket. Si es temporal, copia al responsable de la temporal.
                $cc = [ $ticket->usuario->email, $userAuthorizes->email ];

                $responsableTemp = $ticket->contrato->temporal;
                //Si es temporal, entonces se envía correo al responsable de la temporal.
                if(isset($responsableTemp) and isset($responsableTemp->prospecto->PROS_CORREO))
                    $to[] = $responsableTemp->prospecto->PROS_CORREO;

                $responsableGH = $ticket->contrato->empleador;
                //Si es directo, entonces se dirige al responsable de gestión humana del empleador
                if(isset($responsableGH))
                    $to[] = $responsableGH->prospecto->PROS_CORREO;

                $message->to($to);
                $message->cc($cc);
            });
        } catch(\Exception $e){
            $this->logError('Error enviando correo para ticket '.$ticket->TICK_ID.'. Error: '.$e->getMessage());
        }
    }
}
