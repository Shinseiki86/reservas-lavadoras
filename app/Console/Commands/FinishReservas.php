<?php

namespace LAVA\Console\Commands;

use Illuminate\Console\Command;

use Mail;
use Carbon\Carbon;
use LAVA\Models\Reserva;
use LAVA\Models\EstadoReserva;

class FinishReservas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservas:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finaliza las reservas que cumplieron la fecha de vigencia.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $hayPend = false;
        $reservas = Reserva::whereIn('RESERVAS.ESRE_ID', [EstadoReserva::PENDIENTE, EstadoReserva::APROBADA])
                                ->get();

        //$bar = $this->output->createProgressBar(count($encuestas));

        foreach ($reservas as $key => $reserva) {
            $RESE_FECHAINI = Carbon::parse($reserva->RESE_FECHAINI)->second(0);
            $RESE_FECHAFIN = $RESE_FECHAINI->addHours($reserva->RESE_HORAS);
            $ahora = Carbon::now()->second(0);


            //Si la fecha de vigencia de la reserva es menor a la fecha actual...
            if($RESE_FECHAFIN < $ahora ){
                $reserva->update(['ESRE_ID' => EstadoReserva::FINALIZADA]);

                //Enviar correo al creador de la reserva
                //$this->sendEmailAlert($reserva, 'emails.alert_encuesta_cerrada', 'finalizada');

                $this->info('Reserva '.$reserva->RESE_ID.' finalizada.');
                $hayPend = true;
            }
            /*//Si la vigencia de la encuesta caduca en 1 día...
            elseif ($ENCU_fechavigencia->eq($ahora->addDay())) {
                //Enviar correo al creador de la encuesta
                $this->info('Encuesta '.$encuesta->ENCU_id.' finalizará en 24 horas.');
                $this->sendEmailAlert($encuesta, 'emails.alert_encuesta_proxima_cerrar', 'próxima a finalizar');
            }*/
            
            //$bar->advance(); 
        }
        //$bar->finish();

        if(!$hayPend)
            $this->info('No hay reservas para finalizar.');
    }



    private function sendEmailAlert($encuesta, $view, $asunto)
    {
        //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
        \Mail::send($view, compact('encuesta'), function($message) use ($encuesta, $asunto){

            //Se obtiene el usuario que creó la encuesta
            $user = \Eva360\User::where('username', $encuesta->ENCU_creadopor)
                                    ->get()->first();

            dump($user->name, $user->email);
            //remitente
            $message->from(env('MAIL_USERNAME'), env('MAIL_NAME'));
            //asunto
            $message->subject('Encuesta '.$encuesta->ENCU_id.' '.$asunto);
            //receptor
            $message->to($user->email, $user->name);
        });
        //return \View::make('success');
    }
}
