<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Event;
use App\Attendee;
use App\Account;

/**
 * Undocumented class
 */
class AuthService
{

    private static function verifyAndInviteUsers($request, $id)
    {

        $auth = resolve('Kreait\Firebase\Auth');

        //intentamos buscar el usuario en la autenticacion o lo creamos
        $userData = null;
        try {
            $userData = $auth->getUserByEmail($request->email);
        } catch (\Exception $e) {
            $url = "http://localhost:3020";
            $data = json_encode($request->json()->all());
            $httpRequest = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => $data,
                ),
            );
            $context = stream_context_create($httpRequest);
            $response = json_decode(file_get_contents($url, false, $context));
            $userData = $auth->getUserByEmail($request->email);
        }
        if (!$userData->uid) {
            return "false";
        }

        try {

            //acualizamos la información del usuario
            $user = Account::firstOrNew(['uid' => $userData->uid]);
            $user->fill($request->json()->all());
            $user->uid = $userData->uid;
            $user->save();

            //actualizamos el UserEvent
            $userEvent = Attendee::firstOrNew(
                ['account_id' => $userData->uid,
                    'event_id' => $id,
                ]);

            $userEvent->fill($request->json()->all());
            $userEvent->account_id = $userData->uid;
            $userEvent->event_id = $id;

            if (!isset($userEvent->rol_id)) {
                $rol = Rol::where('level', 0)->first();
                $userEvent->rol_id = $rol->_id;
            }

            if (!isset($userEvent->status)) {
                //Aca jala el primer estado que se encuentra, por que se necesita uno por defecto
                $temp = State::first();
                $userEvent->state_id = $temp->_id;
            }

            $userEvent->save();

            return "true";

        } catch (\Exception $e) {
            //var_dump($e->getMessage());
            return "false";
        }

        return "true";
    }


}
