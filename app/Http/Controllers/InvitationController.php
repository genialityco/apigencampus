<?php

namespace App\Http\Controllers;

use App\Account;
use App\Attendee;
use App\Event;
use App\Invitation;
use App\Mailing;
use App\Mail\UserToUserRequest;
use App\NetworkingContacts;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Kreait\Firebase\Exception\Auth\AuthError;
use Kreait\Firebase\Exception\Auth\EmailNotFound;
// firebase errro catch
//use Kreait\Firebase\Exception\Auth\ApiConnectionFailed;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\InvalidArgumentException;
use Log;
use Mail;
use Redirect;
use Storage;

/**
 * @group Invitation
 *
*/
class InvitationController extends Controller
{
    public function __construct(\Kreait\Firebase\Auth $auth)
    {
        $this->auth = $auth;
    }


    /**
     * _generateLoginLinkAndRedirect_ : generate login link and redirect
     * 
     * @bodyParam email email required
     * @bodyParam password string 
     * 
     * @param string $email
     * @param string $pass
     * @param string $innerpath
     * @return void
     */
    public function generateLoginLinkAndRedirect($email, $pass=null, $eventId , $innerpath ="",$destination=null) {

        try {

            $destination  = ($destination)?$destination:config('app.front_url');

            if(substr($destination, -1) == '/') {
                $destination = substr($destination, 0, -1);
            }
           
            $passdecrypt = ($pass)?self::decryptdata($pass):'evius.2040';
            $userinfo = $this->auth->getUserByEmail($email);

            try {
                $updatedUser = $this->auth->changeUserPassword($userinfo->uid, $passdecrypt);
                

            } catch (InvalidArgumentException $e) {
                $updatedUser = $this->auth->changeUserPassword($userinfo->uid, $pass);

            } catch (AuthError $e) {
                Log::error("temp password used. " . $e->getMessage());
                $passdecrypt  = "evius.2040";
                $updatedUser = $this->auth->changeUserPassword($userinfo->uid, $passdecrypt );
            }
           

            $singin = $this->auth->signInWithEmailAndPassword($email, $passdecrypt );
            $innerpathString = isset($innerpath) ? '/'. $innerpath : "";

            $user = Account::where("uid", $userinfo->uid)->first();
            if (!$user) {
                //intentamos buscar por correo cómo segunda opción
                $user = Account::where("email", $email)->first();
                if (!$user) {
                    return Redirect::to($destination."/" . "landing/" . $eventId . $innerpath);
                }
                $user->uid = $userinfo->uid;
            }

            $refresh_token["refresh_token"] = $singin->refreshToken();
            $user->fill($refresh_token);
            $user->save();

            

            return Redirect::to($destination."/" . "landing/" . $eventId . $innerpath . "?token=" . $singin->idToken());

        } catch (EmailNotFound $e) {

            Log::error("email no encontrado. " . $e->getMessage());
            return Redirect::to($destination."/" . "landing/" . $eventId);

        } catch (UserNotFound $e) {
            Log::error("usuario no encontrado. " . $e->getMessage());
            return Redirect::to($destination."/" . "landing/" . $eventId);

        } catch (InvalidPassword $e) {
            Log::error("contrasena invalida. " . $e->getMessage());
            return Redirect::to($destination."/" . "landing/" . $eventId);

        } catch (Exception $e) {

            Log::error("Error message. " . $e->getMessage());
            return Redirect::to($destination."/" . "landing/" . $eventId);

        }

    }
    

    /**
     * _singIn_: singIn
     *
     * @param Request $request
     * @return void
     */
    public function singIn(Request $request)
    {   
        $innerpath = ($request->has("innerpath")) ? $request->input("innerpath") : "";
        $eventId = ($request->has("event_id")) ? $request->input("event_id") : "";
        $destination = ($request->has("destination")) ? $request->input("destination") : null;


        if ($request->input("request")) {
            try {
                self::acceptOrDeclineFriendRequest($request, $eventId, $request->input("request"), $request->input("response"));
            } catch (Exception $e) {

            }
        }

        $pass  = $request->input("pass");
        $email = $request->input("email");

        return self::generateLoginLinkAndRedirect( $email, $pass, $eventId,  $innerpath, $destination);

    }


    private function decryptdata($string)
    {

        $options = 0;
        $ciphering = "AES-128-CTR";
        // Non-NULL Initialization Vector for encryption
        $decryption_iv = config('app.encryption_iv');

        // Store the encryption key
        $decryption_key = config('app.encryption_key');

        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt($string, $ciphering,
            $decryption_key, $options, $decryption_iv);

        return $decryption;
    }

    /**
     * _index_: Display a listing of the Invitation.
     * 
     * @urlParam event_id required
     * 
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
            Invitation::where("event_id", $event_id)->paginate(10000)
        );
    }

    /**
     * _invitationsSent_:List of applications sent
     *
     * @urlParam event_id
     * @urlParam user_id
     * 
     * @return void
    */
    public function invitationsSent($event_id, $user_id)
    {
        return JsonResource::collection(
            Invitation::where("id_user_requested", $user_id)->where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * _invitationsReceived_: List of applications recived
     *
     * @urlParam event_id
     * @urlParam user_id
     * 
     * @param Request $request
     * @return void
     */
    public function invitationsReceived($event_id, $user_id)
    {
        return JsonResource::collection(
            Invitation::where("id_user_requesting", $user_id)->where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * _indexcontacts_: List of current contacts
     *
     * @urlParam event_id
     * @urlParam user_id
     * 
     * @return void
     */
    public function indexcontacts($event_id, $user_id)
    {

        $contacts = NetworkingContacts::where("user_account", $user_id)->where("event_id", $event_id)->get()->toArray();

        if (!empty($contacts[0]["contacts_id"])) {
            $contacts_id = $contacts[0]["contacts_id"];
            if (!is_null($contacts_id)) {
                return JsonResource::collection(Attendee::find($contacts_id)->makeHidden(["rol", "activities"]));

            }}
        return "aun no tienes contactos.";

    }

    /**
     * _store_: Send request with redirection to evius
     * 
     * Enviar solicitud con redirección a evius
     * 
     * @urlParam event_id required
     * 
     * @bodyParam id_user_requested string required
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {

        // end point para enviar solicitud con redireccion a evius
        $data = $request->json()->all();

        // verifica si ya son contactos
        $id_user_requesting = $data["id_user_requesting"];

        $model = NetworkingContacts::where("user_account", $data["id_user_requested"])->first();        
        $innerpath = (isset($data["innerpath"])) ? $data["innerpath"] : "/networking";
        /*
        if ($model) {
        if (is_int(array_search($data["id_user_requesting"], $model->contacts_id))) {
        abort(409, "Ya se encuentra en tu lista de contactos");
        }
        }
        $model = Invitation::where("id_user_requesting", $data["id_user_requesting"])->where("id_user_requested", $data["id_user_requested"])->first();
        //verifica si ya se ha enviado una solicitud de amistad igual y el estado de esta
        if ($model) {
        if ($model->response) {
        return $model->response == "rejected" ? abort(409, "Solictiud ya ha sido enviada anteriormente y se encuentra rechazada") : abort(409, "Solictiud ya ha sido  enviada anteriormente y se encuentra aceptada");
        }
        return abort(409, "Solictiud ya ha sido enviada anteriormente, esperando respuesta de solicitud");
        }
         */

        $result = new Invitation($data);
        $result->save();
        $data["request_id"] = $result->_id;
        self::buildMessage($data, $event_id, $innerpath);
        return $result;
    }

    public function sendPushNotification($push_notification)
    {
        $url = config('app.api_evius') . "/events/" . $push_notification["event_id"] . "/sendpush";
        echo var_dump($push_notification);
        $fields = array('event_id' => $push_notification["event_id"], 'title' => "Nueva solicitud", 'img' => true, 'body' => $push_notification["body"], 'User_ids' => [$push_notification["User_ids"]]);

        $headers = array('Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * _acceptOrDeclineFriendRequest_: Accept Or Decline Friend Request
     *
     * @urlParam event_id required
     * @urlParam id required user who accepts or rejects the application
     * 
     * @bodyParam response string required
     * 
     * @param Request $request
     * @param String $event_id
     * @param String $id
     * @param string $response_alt
     * @return void
     */
    public function acceptOrDeclineFriendRequest(Request $request, String $event_id, String $id, $response_alt = "accepted")
    {
        $innerpath = '/networking';
        $data = $request->json()->all();
        $Invitation = Invitation::find($id);
        $data["response"] = ($data && isset($data["response"])) ? $data["response"] : $response_alt;
        self::verifyAndAddContact($Invitation, $data);
        $resp["response"] = $data["response"] ? $data["response"] : $response_alt;

        $Invitation->fill($resp);
        $Invitation->save();
        $resp["id_user_requested"] = $Invitation->id_user_requested;
        $resp["id_user_requesting"] = $Invitation->id_user_requesting;
        return self::buildMessage($resp, $event_id,  $innerpath);
    }

    public function verifyAndAddContact($Invitation, $data)
    {

        if ($data["response"] == "accepted" || $data["response"] == "acepted") {
            $user_requested = NetworkingContacts::where("user_account", $Invitation->id_user_requested)->where("event_id", $Invitation->event_id)->first();
            if ($user_requested) {

                $contacts_id = $user_requested->contacts_id;
                $new_contact = [$Invitation->id_user_requesting];
                $contact_merge["contacts_id"] = array_unique(array_merge($new_contact, $contacts_id));
                $user_requested->fill($contact_merge);
                $user_requested->save();

            } else {

                $data_contact["contacts_id"] = [$Invitation->id_user_requesting];
                $data_contact["event_id"] = $Invitation->event_id;
                $data_contact["user_account"] = $Invitation->id_user_requested;
                $save_contacts = new NetworkingContacts($data_contact);
                $save_contacts->save();
            }

            $user_requesting = NetworkingContacts::where("user_account", $Invitation->id_user_requesting)->where("event_id", $Invitation->event_id)->first();
            if ($user_requesting) {

                $contacts_id = $user_requesting->contacts_id;
                $new_contact = [$Invitation->id_user_requested];
                $contact_merge["contacts_id"] = array_unique(array_merge($new_contact, $contacts_id));

                $user_requesting->fill($contact_merge);
                $user_requesting->save();

            } else {

                $data_contact["contacts_id"] = [$Invitation->id_user_requested];
                $data_contact["event_id"] = $Invitation->event_id;
                $data_contact["user_account"] = $Invitation->id_user_requesting;
                $save_contacts = new NetworkingContacts($data_contact);
                $save_contacts->save();
            }

            return "contacto agregado";
        }
    }

    public function meetingrequestnotify(Request $request, $event_id)
    {

        $data = $request->json()->all();

        self::buildMeetingRequestMessage($data, $event_id);

    }

    /**
     * _buildMeetingRequestMessage_: Build Meeting Request Message
     *
     * @urlParam event_id required
     * 
     * @bodyParam $data required
     * 
     * @return void
     */
    public function buildMeetingRequestMessage($data, String $event_id)
    {
        $event = Event::find($event_id);
        $receiver = Attendee::find($data["id_user_requested"]);
        $sender = Attendee::find($data["id_user_requesting"]);

        $mail["id_user_requesting"] = $data["id_user_requesting"];
        $mail["id_user_requested"] = $data["id_user_requested"];

        $mail["mails"] = $receiver->email ? [$receiver->email] : [$receiver->properties["email"]];
        $mail["sender"] = $event->name;
        $mail["event_id"] = $event_id;

        if (!empty($data["request_id"])) {
            $mail["request_id"] = $data["request_id"];
        }

        $meetingStartTime = (isset($data["start_time"])) ? $data["start_time"] : "";

        $request_type = "meeting";
        $mail["subject"] = $sender->properties["names"] . " te ha enviado una solicitud de reunión a las: " . $meetingStartTime . ".";
        $mail["title"] = $sender->properties["names"] . " te ha enviado una solicitud de reunión" . ".";
        $mail["desc"] = "Hola " . $receiver->properties["names"] . ", quiero contactarte por medio del evento " . $event->name. " para tener una reunión a las ". $meetingStartTime . ".";

        $mail["desc"] .= "<br><br><p>Puedes ingresar al evento a la sección Networking / Agéndate para revisar las solicitudes, para aceptarlas ó rechazarlas.</p>";

        self::sendEmail($mail, $event_id, $receiver, $sender, $request_type);
        return "Request / response send";
    }

    
    public function buildMeetingResponseMessage($data, String $event_id, $innerpath){
        $request_type = "meeting";
        $event = Event::find($event_id);
        $sender = Attendee::find($data["id_user_requesting"]);
        $receiver  = Attendee::find($data["id_user_requested"]);
        
        $mail["id_user_requesting"] = $data["id_user_requesting"];
        $mail["id_user_requested"] = $data["id_user_requested"];
        $mail["mails"] = $receiver->email ? [$receiver->email] : [$receiver->properties["email"]];
        $mail["sender"] = $event->name;
        $mail["event_id"] = $event_id;
        $mail["status"] = $data["response"];

        $formated_meeting_time = isset($data["timestamp_start"])? Carbon::parse($data["timestamp_start"])->format('F d h:m a'):'';  

        if (!empty($data["request_id"])) {
            $mail["request_id"] = $data["request_id"];
        } 
        
        
        $datos_usuario = "";
        $i = 0;
        

        foreach ($event->user_properties as $property) {
            if ($i <= 3) {

                if (isset($receiver->properties[$property->name]) && $receiver->properties[$property->name] && $property->type !== "avatar") {
                    $i++;
                    $datos_usuario .= "<p>{$property->label}: {$receiver->properties[$property->name]}</p>";
                }
            }
        }
        
        $cuantos = count($event->user_properties);        
        
        $rejected_message = " Lo sentimos " . $receiver->properties["names"] . " ha declinado tu solicitud de reunión para el evento " . $event->name;
//         $accepted_message = <<<EOT

//         {$receiver->properties["names"]} ha aceptado tu solicitud de reunión para el evento {$event->name} <br/>
//         Cuando {$formated_meeting_time}

//         <br />
//         {$datos_usuario}
//         <br/>
//         Mostrando {$i} datos de {$cuantos}
//         <br />
//         Para ver toda la información del nuevo contacto dirigete al evento con el botón inferior ve a la sección contecta/networking
//         y visita Mis Contactos, alli encontraras toda la nueva información.<br/>
// <br/>
//         No olvides disfrutar el resto de experiencias del evento.
// EOT;  

        $accepted_message = "<br/><br/>".$receiver->properties["names"] . " ha aceptado tu solicitud de reunión para el evento {$event->name} <br/><br/>" .
                            "Cuando " . $formated_meeting_time . "<br/><br/>" .
                            $datos_usuario . "<br/>" .                            
                            "Para ver toda la información del nuevo contacto dirigete al evento con el botón inferior ve a la sección contecta/networkingy
                            visita Mis Contactos, alli encontraras toda la nueva información<br/><br/>".
                            "No olvides disfrutar el resto de experiencias del evento.";

        $mail["mails"] = $sender->email ? [$sender->email] : [$sender->properties["email"]];
        $mail["title"] = $data["response"] == "accepted" ? $receiver->properties["names"] . " ha aceptado tu solicitud" : $receiver->properties["names"] . " Ha declinado tu solicitud de reunión";
        $mail["desc"] = $data["response"] == "accepted" ? $accepted_message : $rejected_message;
        $mail["subject"] = "Respuesta a solicitud de reunión ".$formated_meeting_time;

        $innertpath ="/networking";
        self::sendEmail($mail, $event_id, $innertpath, $receiver, $sender, $request_type);
        return "Request / response send";        

    }

    /**
     * _buildMessage_: Build contact request message 
     *
     * @bodyParam $data
     * 
     * @return void
     */
    public function buildMessage($data, String $event_id, $innerpath)
    {

        $event = Event::find($event_id);
        $receiver = Attendee::find($data["id_user_requesting"]);
        $sender = Attendee::find($data["id_user_requested"]);

        $mail["id_user_requesting"] = $data["id_user_requesting"];
        $mail["id_user_requested"] = $data["id_user_requested"];
        $mail["mails"] = $receiver->email ? [$receiver->email] : [$receiver->properties["email"]];
        $mail["sender"] = $event->name;
        $mail["event_id"] = $event_id;

        if (!empty($data["request_id"])) {
            $mail["request_id"] = $data["request_id"];
        }

        $request_type = "friendship";
        $mail["subject"] = $sender->properties["names"] . " te ha enviado una solicitud de contacto";
        $mail["title"] = $sender->properties["names"] . " te ha enviado una solicitud de contacto";
        $mail["desc"] = 
        "Hola " .  $receiver->properties["names"] . " quiero contactarte por medio del evento ".  $event->name . "<br/><br/>

        Las personas que no son contactos tuyos solamente tienen visible una parte de tu información,por lo cual pueden buscarte en el evento pero no contactarte. 

        Una vez aceptes la solicitud de contacto " . $sender->properties["names"] ." podrá ver tu información completa en el evento en la sección Networking / Agéndate
        de esta forma podrá contactarte.";
        $rejected_message = " Lo sentimos " . $receiver->properties["names"] . " ha declinado tu solicitud de amistad para el evento " . $event->name;

        $datos_usuario = "";
        $i = 0;
        foreach ($event->user_properties as $property) {
            if ($i <= 3) {

                if (isset($receiver->properties[$property->name]) && $receiver->properties[$property->name]) {
                    $i++;
                    $datos_usuario .= "<p>{$property->label}: {$receiver->properties[$property->name]}</p>";
                }
            }
        }

        $cuantos = count($event->user_properties);

        $accepted_message = $receiver->properties["names"] . " ha aceptado tu solicitud de contacto para el evento " .$event->name . "<br>" .
         $datos_usuario .
        
        "Para ver toda la información del nuevo contacto dirigete al evento con el botón inferior ve a la sección contecta/networking
        y visita Mis Contactos, alli encontraras toda la nueva información.

        No olvides disfrutar el resto de experiencias del evento.";

        if (!empty($data["response"])) {
            $mail["mails"] = $sender->email ? [$sender->email] : [$sender->properties["email"]];
            $mail["title"] = $data["response"] == "accepted" ? $receiver->properties["names"] . " ha aceptado tu solicitud" : $receiver->properties["names"] . " Ha declinado tu solicitud de amistad";
            $mail["desc"] = $data["response"] == "accepted" ? $accepted_message : $rejected_message;
            $mail["subject"] = "Respuesta a solicitud de amistad";
        }

        //echo self::sendPushNotification($push_notification);
        self::sendEmail($mail, $event_id, $innerpath, $receiver, $sender, $request_type);
        return "Request / response send";
    }

    /**
     * _sendEmail_: Send Email
     *
     * @bodyParam $mail array required
     * @bodyParam $event_id string required
     * @bodyParam $receiver string required
     * @bodyParam $sender_user string required
     * @bodyParam $request_type string required
     * @return void
     */
    public function sendEmail($mail, $event_id, $innerpath, $receiver, $sender_user, $request_type)
    {

        $mail["event_id"] = $event_id;
        $mail["type"] = "friend request sent";
        $result = new Mailing($mail);
        $title = $mail["title"];
        $desc = $mail["desc"];
        $img = "no img for now";
        $sender = $mail["sender"];
        $subject = $mail["subject"];
        $result->save();
        $response = !empty($mail["request_id"]) ? $mail["request_id"] : null;
        $status = !empty($mail["status"]) ? $mail["status"] : null;

        foreach ($mail["mails"] as $key => $email) {
            Mail::to($email)->send(
                new UserToUserRequest($event_id, $innerpath, $request_type, $title, $desc, $subject, $img, $sender, $response, $email, $receiver, $sender_user, $status)
            );
        }

        foreach ($mail["mails"] as $key => $email) {
            Mail::to("juan.lopez@mocionsoft.com")->send(
                new UserToUserRequest($event_id, $innerpath, $request_type, $title, $desc, $subject, $img, $sender, $response, $email, $receiver, $sender_user, $status)
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invitation  $Invitation
     * @return \Illuminate\Http\Response
     */
    public function show(string $event_id, string $id)
    {
        // esto muestra la informacion filtrada por event user

        $Invitation = Invitation::findOrFail($id);
        $response = new JsonResource($Invitation);
        return $response;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invitation  $Invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $event_id, string $id)
    {
        $data = $request->json()->all();
        $Invitation = Invitation::findOrFail($id);
        $Invitation->fill($data);
        $Invitation->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, string $event_id, string $id)
    {
        $Invitation = Invitation::findOrFail($id);
        return (string) $Invitation->delete();

    }

    public function SendInvitation(Request $request)
    {
        echo "hi";die;
        //     $data = $request->json()->all();
        //     if ($request->get('send') == '1') {
        //         $pdf = PDF::loadview('Public.ViewEvent.Partials.Invitation', $data);
        //         $pdf->setPaper( 'letter',  'landscape' );
        //         return $pdf->download('content.pdf');
        //         return view('Public.ViewEvent.Partials.ContentMail', $data);
        //         $data_single = "tfrdrummer@gmail.com";
        //         Mail::send("Public.ViewEvent.Partials.ContentMail",$data , function ($message) use ($data,$pdf,$data_single){
        //             $message->to($data_single,"Evento PMI")
        //             ->subject("HIÂ¡","ni idea");
        //         });
        //
        //     }
        //     return view('Public.ViewEvent.Partials.Invitation', $data);

    }

}