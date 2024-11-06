<?php

namespace App\Jobs;

use App\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GuessPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;
    #default value example
    public $hashedPassword = '$2y$10$M0.cQyVFDpZmfXYTT.xLwemnSzbEffDrjfkHGujnNYpiHzQAllYcC';
    public $initial_password=1141314588;
    public $rango;
    public $event_user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($password,$initial_password=0,$rango, $event_user)
    {
        $this->hashedPassword = $password;
        $this->initial_password = $initial_password;
        $this->rango = $rango;
        $this->event_user = $event_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	echo 'hola';
        set_time_limit(0);
        ini_set('max_execution_time', 0);

       /**
        * 
        * - Consultar en la base de datos los asistenes del evento
        * - Leer el password encriptado
        * - de rangos de 10000 ir lanzando el job que busca si coincide con el password encriptado
        * - si coincide guardar en el usuario el password desecriptado
        */
        echo "hashed ".$this->hashedPassword;
        
	$fina_password = $this->initial_password + $this->rango;
        //$fina_password = 1141314590;
        //$passwordoriginal = '1.141.314.588';
        $password_descubierta = '';
        $first  = new \DateTime();

        for ($i = $this->initial_password; $i <= $fina_password; $i++) {
            if (password_verify($i,  $this->hashedPassword)) {
                $password_descubierta = $i;

		$event_user = Attendee::findOrFail($this->event_user);
		$event_user->cedula = $password_descubierta;
		$event_user->save();

                break;
            }
        }

        $second = new \DateTime();
        $diff = $first->diff($second);
        $out = $password_descubierta ? 'descubierta':'escondida';
        $out .= ": " . $password_descubierta . ' tomo:' . $diff->format('%H:%I:%S ') . ' -- rango' . $this->initial_password . ':' . $fina_password;
        echo  $out;
        Log::debug($out);
    }
}
