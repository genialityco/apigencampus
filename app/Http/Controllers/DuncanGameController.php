<?php

namespace App\Http\Controllers;

use App\Attendee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// firebase errro catch
//use Kreait\Firebase\Exception\Auth\ApiConnectionFailed;
use Validator;

/**
 * @group Duncan
 * Controla la dinámica de puntajes para una experiencia de un cliente (disney) pra un juego de lanzamiento que se realizo en agosto del 2020
 */
class DuncanGameController extends Controller
{
    public function __construct(\Kreait\Firebase\Auth $auth)
    {
        $this->auth = $auth;
    }

    const DUNCAN_EVENT_ID = "5f3fecdc5480a53a9f721bc2";
    const LIMITESEGUNDOSPARAJUGARNUEVAMENTE = 3600;
    const AVALIABLE_GAMES = ["darts", "spaceinvaders", "annie", "rullettee"];

    /**
     * Duncan juego. Guardamos el puntaje con el timestamp para después poder limitar la cantiadad de veces jugadas por tiempo
     * @param Request $request
     * @return \App\Attendee
     */
    public function guardarpuntaje(Request $request)
    {
        $data = $request->json()->all();
        $rules = [
            'user_id' => 'required',
            'game' => ["required", Rule::in(DuncanGameController::AVALIABLE_GAMES)],
            'puntaje' => ['required', 'numeric'],
        ];
        $messages = ['in' => "Game should be one of: " . implode(", ", DuncanGameController::AVALIABLE_GAMES)];
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }

        $attendee = Attendee::where('account_id', $data['user_id'])->where('event_id', DuncanGameController::DUNCAN_EVENT_ID)->first();
        $nombre_campo_juego = $data['game'] . "_timestamp";

        $properties = $attendee->properties;

        //Vamos a limitar la guardada de puntaje para que guarde si la condición de tiempo se cumple, sino error.
        if (isset($attendee->properties[$nombre_campo_juego])) {
            DuncanGameController::LIMITESEGUNDOSPARAJUGARNUEVAMENTE;
            $timestampultimojuego = $attendee->properties[$nombre_campo_juego];
            if ($timestampultimojuego) {
                $timestampahora = time();
                if (DuncanGameController::LIMITESEGUNDOSPARAJUGARNUEVAMENTE - ($timestampahora - $timestampultimojuego) > 0) {
                    return response()->json(['errors' => "No se ha cumplido el tiempo para jugar, el puntaje no se suma, se necesitan " . DuncanGameController::LIMITESEGUNDOSPARAJUGARNUEVAMENTE . " segundos entre juego y juego"], 400);
                }
            }
        }

        //actualizamos el tiempo de la última jugada
        $properties[$nombre_campo_juego] = time();
        //sumamos el puntaje al puntaje que ya tiene el usuario si exsite
        $properties["puntaje"] = (isset($properties["puntaje"]) && $properties["puntaje"]) ? ($properties["puntaje"] + $data["puntaje"]) : $data["puntaje"];

        $attendee->properties = $properties;

        $attendee->save();
        return $attendee;

    }

    /**
     * 
     * _minutosparajugar_:Duncan juego. Número de segundos desde que jugue.
     * Número de segundos desde que jugue menos una hora que es límite de tiempo para volver a jugar, si el número es positivo no puedo jugar, si es negativo significa que ya paso más de una hora.
     * @param Request $request
     * @return int
     * 
     */
    public function minutosparajugar(Request $request)
    {
        $data = $request->input();

        // if(isset($data['user_id']))
        // {
        //     $rules = [
        //         'user_id' => 'required', //Must be a number and length of value is 8
        //         'game' => ["required", Rule::in(DuncanGameController::AVALIABLE_GAMES)],
        //     ];
        //     $messages = ['in' => "Game should be one of: " . implode(", ", DuncanGameController::AVALIABLE_GAMES)];
        //     $validator = Validator::make($data, $rules, $messages);
        //     if (!$validator->passes()) {
        //         return response()->json(['errors' => $validator->errors()->all()], 400);
        //     }
    
        //     $attendee = Attendee::where('account_id', $data['user_id'])->where('event_id', DuncanGameController::DUNCAN_EVENT_ID)->first();
        //     $nombre_campo_juego = $data['game'] . "_timestamp";
    
        //     $timestampultimojuego = isset($attendee->properties[$nombre_campo_juego]) ? $attendee->properties[$nombre_campo_juego] : null;
        //     $timestampahora = time();
    
        //     //Condición si núnca  ha jugado retornamos un número negativo para indicar que puede jugar
        //     if (!$timestampultimojuego) {
        //         return -1;
        //     }
        //     return DuncanGameController::LIMITESEGUNDOSPARAJUGARNUEVAMENTE - ($timestampahora - $timestampultimojuego);
        // }
        $timestampultimojuego = null;
        $timestampahora = time();
        
        return $timestampultimojuego;
    }

    /**
     * _invitaramigos_:Mensaje que se enviará mediante SMS al usuario invitado
     *
     * @param Request $request
     * @return string confirmación de que el mensaje fue enviado
     *
     */
    public function invitaramigos(Request $request)
    {

        $data = $request->json()->all();
        
        foreach ($data as $key => $item){
            //Se le asigna 200 puntos al usuario por cada invitación
            $attendee = Attendee::where('account_id', $item['user_id'])->where('event_id', DuncanGameController::DUNCAN_EVENT_ID)->first();

            $properties = $attendee->properties;

            
            $nombre_campo_juego = 'arboltimestamp';                        

            if (isset($attendee->properties[$nombre_campo_juego])) {
                $timestampultimojuego = $attendee->properties[$nombre_campo_juego];
                var_dump($attendee->properties[$nombre_campo_juego]);
                    if ($timestampultimojuego >  0) {
                        return  "Lo sentimos ya has invitado a tus amigos";
                    }                
            }

            $properties["puntaje"] = (isset($properties["puntaje"]) && $properties["puntaje"]) ? ($properties["puntaje"] + 200) : 200;

            $attendee->properties = $properties;

            $attendee->save();


            //Paso de parámetros para SMS
            $info = [
                "from" => "InfoSMS",
                "to" => "57".$item['phone'],
                "text" => "Hola! " .$item['name'].", ". $item['username']." te quiere invitar a conocer una familia diferente, igual a todas. Ingresa a https://llegaduncanville.com y disfruta el evento. Aplican T&C."
            ];
            $client = new \GuzzleHttp\Client();
            $headers = [
                'Authorization' => 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];
            $response = $client->request('POST','http://api.messaging-service.com/sms/1/text/single', 
            [
                'allow_redirects' => false , 
                'auth' => ['mocionsoft' , 'Mocion_77725!'], 
                'json' => $info,
                'headers' => $headers,
            ]); 

        }

        //actualizamos el tiempo de la última invitación
        $properties[$nombre_campo_juego] = time();
        $attendee->properties = $properties;
        $attendee->save(); 

                
        return "Mensaje enviado";

    }

    /* Estos usuarios no tienen teléfono Sin telefono
    <p>JxFocNoaLjcl7pP1fFdrtmiGJtb2 </p>
    <p>Wg1SKUEJ4XTxYFvcEI4qsKsf3Pg2 </p>1000

    Estos usuarios no tienen un registro de auth para loguearse es un error mirar porque paso
    <p>5f483dd494494c7ed06e1ebc </p>
    <p>5f47b05e68826960ce50b560 </p>1266

    Estos usuarios no tienen uid tampoco
    <p>-->>5f46a7abbb0594163467fc27 +573007506738</p>
    <p>-->>5f469276e280f66e4e6e1763 3017864991</p>
    <p>-->>5f46b99b90341c66523916d5 313448594454</p>
    <p>-->>5f47f9f4a741d37add114f23 3224818611</p>
    <p>-->>5f46957f1928da3e842ef446 3176937873</p>
    <p>-->>5f46b22965ee6d123a04ef49 3143590550</p>
    <p>-->>5f45f8a4bc24a362bf367e23 3254698485</p>
    <p>-->>5f4359719a09f70150203708 3134859666</p>
    <p>-->>5f48259c5a5e1777dc023207 3007819686</p>1266

     */

    public function setphoneaspassword()
    {
        $asistentes = Attendee::where("event_id", DuncanGameController::DUNCAN_EVENT_ID)->limit(10000)->get();
        foreach ($asistentes as $asistente) {
            if (!isset($asistente->properties["phone"])) {
                continue;
            }
            if (!isset($asistente->user)) {
                continue;
            }
            if (!isset($asistente->user->uid) || !$asistente->user->uid) {
                continue; //echo "<p>-->>" . $asistente->_id . " " . $asistente->properties["phone"] . "</p>"; 
            }
 
            if (strlen($asistente->properties["phone"]) < 6) {
                continue; //echo "<p>-->>" . $asistente->_id . " " . $asistente->properties["phone"] . "</p>"; 
            }            
            



            // if ($asistente->properties["email"] !== "ivan.sanchez@mocionsoft.com") {
            //     continue;
            // }

            echo "<p>" . $asistente->user->uid . " " . $asistente->properties["phone"] . "</p>";
            $updatedUser = $this->auth->changeUserPassword($asistente->user->uid, $asistente->properties["phone"]);
        }

        return count($asistentes);
    }

}
