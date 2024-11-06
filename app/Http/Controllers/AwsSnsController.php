<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Log;

use App\Jobs\SendNotificationEmailJob;
use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;

use Illuminate\Contracts\Mail\Mailer;

use Aws\Sns\Message;
use Aws\Sns\MessageValidator;

use App\MessageUserUpdate;
use App\MessageUser;
use App\Message as EviusMessage;


class AwsSnsController extends Controller
{
   
    public function updateSnsMessages(Request $request)
    {        
        Log::info($request);
        $response = $request->json()->all();
        $responseMail = $response['mail'];                                
        
        $status_message = null;

        //Se toma el satstus del mensaje (Send, Open,Click Delivery, Bounce)
        if(isset($response['eventType']))
        {
            $status_message = $response['eventType']; 
        }
        else if (isset($response['notificationType']))
        {
            $status_message = $response['notificationType']; 
        }
                                
        //Se organiza la información para el historial.
        $dataMessageUser = [
            'response' => json_encode($response),            
            'status_message' => isset($status_message) ? $status_message : 'queued',
            'status' => isset($status_message) ? $status_message : 'queued',
            // 'notification_id' => $responseMail['messageId'],
            'timestamp_event' => $responseMail['timestamp'],
            'from' => $responseMail['source']
        ];

        //Se busca el mensaje del usuario por el id único generado por AWS
        $messageUser = MessageUser::where('server_message_id' , $responseMail['messageId'])->first();
        
        //Se actualiza el estado del mensaje por usuario.                    
        $messageUser->status = $status_message;
        $messageUser->status_message = $status_message;
        $messageUser->save();

        //Si existe quiere decir que el correo contiene métricas, esto minimiza registros innecesarios.
        if(isset($messageUser->message_id))
        {                                                                                          

            //Se busca el mansaje al caul se le actualizaran las métricas.
            $message = EviusMessage::find($messageUser->message_id);    

            //Dependiendo del estatus se hace la consulta correspondiente para tener el total de mensajes con el status que se está actualizando.
            $total= MessageUser::where('status', '=', $status_message)->where('message_id', '=', $messageUser->message_id)->get();
            switch ($status_message) 
            {
                case 'Send':
                    
                    $message->total_sent++;
                    $message->save();
                break;
                case 'Delivery':
                    $message->total_delivered++;                   
                    $message->save();                    
                break;
                case 'Open':
                    // $total_opened =count($total);
                    $message->total_opened++;
                    $message->save();
                break;
                case 'Click':
                    // $total_clicked =count($total);
                    $message->total_clicked++;
                    $message->save();
                break;
                case 'Bounce':                    
                    $message->total_bounced++;
                    $message->save(); 
                break;
            }
                
                        
        }        
        
        if(is_null($messageUser->history)){
            $messageUser->history = array($dataMessageUser);
        }else{
            $array = $messageUser->history;
            array_push($array, $dataMessageUser);    
            $messageUser->history = $array;
        }
        $message->number_of_recipients = $message->total_sent;
        $message->save(); 
        $messageUser->save();

                       
        return json_encode($request);                     
              
    }
    
    public function testEmail(Mailer $mailer)
    {
        
        $data = [
            'nombre' => 'Marina'
        ];

        $emails = [
            'emilio.vargas@mocionsoft.com',
            'juan.lopez@mocionsoft.com',
            'apps@mocionsoft.com'
        ];      
                            
        $sesMessage = $mailer->send('Mailers/TicketMailer/plantillaprueba', $data, function ($message) use ($emails) {
            $message
                ->to($emails, 'dslfnsd')
                ->subject('prueba')
                                
                $headers = $message->getHeaders();       

                // $eviusmessage->subject = $headers->get('Subject')->getValue();
                // $eviusmessage->message = $message;
                // Log::info(strval($eviusmessage->message));
                // $eviusmessage->save();
                
                $headers->addTextHeader('X-SES-CONFIGURATION-SET', 'ConfigurationSetSendEmail');
        });
        
        
        // Log::info($message);   
        // Log::info('$mens: '.$message->json()->all());          
        // Log::info(json_encode($sesMessage));

        return '<h1>Enviado</h1>';
    }

    // public function getMessage()
    // {
    //     $message = Message::fromRawPostData();

    // }


    /*
    public function sendSnsNotification(Request $request)
    {

        $message = json_decode($request->getContent(), true);
        $data = json_decode(data_get($message, 'MessageAttributes.Information.Value'), true);
        
        Log::info('data '.$data);

        if ($data['status'] === 'updated') {
            Log::info('Actualizando');
        } elseif ($message['status'] === 'deleted') {
            Log::info('Borrando');
        }

    }
    */

}