<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Account;
use App\Rol;
use App\Attendee;
use App\Event;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Order;
use App\State;
use App\DocumentUser;
use App\Bingo;
use App\BingoCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth;

/**
 * Undocumented class
 */
class UserEventService
{

    const CREATED = 'CREATED';
    const UPDATED = 'UPDATED';
    const MESSAGE = 'OK';

    /**
     * Undocumented function
     *
     * @param Event $event
     * @param [type] $userData
     * @return void
     */
    public static function importUserEvent(Event $event, $eventUserFields, $userData)
    {
        // return 0;
        $result_status = null;
        $data = null;
        $message = "OK";
        $date = Carbon::now();
        $date = $date->format('his');

        /* Buscamos el ticket */
        if (isset($eventUserFields['ticket_id']) && !empty($eventUserFields['ticket_id'])) {
            $ticket = Ticket::find($eventUserFields['ticket_id']);
            if ($ticket) {
                $ticket_details['qty'] = 1;
                /*
                 * Update some ticket info
                 */
                $ticket->increment('quantity_sold', $ticket_details['qty']);
                $ticket->increment('sales_volume', ($ticket['price'] * $ticket_details['qty']));
                $ticket->increment('organiser_fees_volume', ($ticket['organiser_booking_fee'] * $ticket_details['qty']));
            }
        }

        /* Si viene el id de la orden en la variable eventUserFields
        buscamos la orden  */
        if (isset($eventUserFields["order_id"])) {

            $order = Order::findOrFail($eventUserFields["order_id"]);

            //Insert order items (for use in generating invoices)

            $orderItem = new OrderItem();
            $orderItem->title = $ticket['title'];
            $orderItem->quantity = 1;
            $orderItem->order_id = $order->id;
            $orderItem->unit_price = $ticket['price'];
            $orderItem->unit_booking_fee = $ticket['booking_fee'] + $ticket['organiser_booking_fee'];
            $orderItem->save();
        }

        
        /* Si no existe el correo le mostramos el error */
        if (!isset($userData['email'])) {
            throw new \Exception('email is missing and is required');
        }
        $userData["password"] = bcrypt($userData["password"]);


        //LLenamos dos campos importantes con valores por defecto por si no vienen
        if (!isset($userData['names'])) {
            $userData['names'] = isset($userData['firstName']) ? $userData['firstName'] : $userData['email'];
        }
        $userData['displayName'] = $userData['names'];

        /* Buscamos primero el usuario por email y sino existe lo creamos */
        $userData['email'] = strtolower($userData['email']);
        $email = $userData['email'];

        $matchAttributes = ['email' => $email];

        
        $user = Account::updateOrCreate($matchAttributes, $userData);

        /* ya con el usuario actualizamos o creamos el eventUser */
        $matchAttributes = ["event_id" => $event->id, "account_id" => $user->_id];
        
        /**** HACEMOS ALGUNOS AJUSTES A LOS CAMPOS antes de importar el eventUser */
        $eventUserFields += $matchAttributes;

        //avoid saving uid as user properties
        if (isset($userData['uid'])) {
            unset($userData['uid']);
        }

        $eventUserFields["properties"] = $userData;

        //Account rol assigned by default
        if (!isset($eventUserFields["rol_id"])) {
            $rol = Rol::where('level', 0)->first();
            if ($rol) {
                $eventUserFields["rol_id"] = $rol->_id;
            } else {
                //Se supone este es un rol por defecto (asistente) si todo el resto falla
                $eventUserFields["rol_id"] = "60e8a7e74f9fb74ccd00dc22";
            }

        }

        //esto por que se nos fue un error en el excel al princiopo
        if (isset($eventUserFields["state_id"])) {
            unset($eventUserFields["state_id"]);
        }

        //eventUser booking status default value
        // Si el usuario no tiene asignado un estado, poner un estado por defecto
        if (!isset($user->state_id) || !$user->state_id) {
            $temp = State::first();
            $eventUserFields["state_id"] = $temp->_id;
        }

        // Si dentro de la petición viene el estado, colocarle el estado que viene en la petición
        if (isset($eventUserFields["state"])) {
            $temp = State::where('name', strtoupper($eventUserFields["state"]))->first();
            //Si encuentra el estado por nombre, es finalmente colocado por id,
            //Si no lo encuentra borra el valor del estado de la petición
            if ($temp && isset($temp->_id)) {
                $eventUserFields["state_id"] = $temp->_id;
            }
            if (isset($eventUserFields["state"])) {
                unset($eventUserFields["state"]);
            }

        }

        /* FINALMENTE */
        $eventUser = null;
        $model = Attendee::where($matchAttributes)->first();

        
        if ($model) {
            //Si algun campo no se envia para importar, debe mantener los datos ya guardados en la base de datos
            $eventUserFields["properties"] = array_merge($model->properties, $eventUserFields["properties"]);
            $model->update($eventUserFields);
            $eventUser = $model;
        } else {
            $eventUser = Attendee::create($eventUserFields);
            // En caso de que el event posea document user
            $document_user = isset($event->extra_config['document_user']) ?$event->extra_config['document_user'] : null ;
            if (!empty($document_user)) {
                $limit = $document_user['quantity'];
                $eventUser = UserEventService::addDocumentUserToEventUserByEvent($event, $eventUser, $limit);
            }
        }
       

        /* Si viene el id de la orden en la variable eventUserFields
        buscamos la orden  */
        if (isset($eventUserFields["order_id"])) {
            $order->save();
        }
/*
array(2) {
["a"]=>
string(24) "5f49421b1985d661d57af862"
["b"]=>
string(10) "1030522402"
5bef34f2854baf00995e018d
}*/ 
        $result_status = ($eventUser->wasRecentlyCreated) ? self::CREATED : self::UPDATED;

        //don't know why updateOrCreate doens't eager load related models
        $eventUser = Attendee::where($matchAttributes)->first();

        $user = Account::find($eventUser->account_id);
        $eventUser->user = $user;
        

        return (object) [
            "status" => $result_status,
            "data" => $eventUser,
            "message" => $message,
        ];
    }
    /**
     * Undocumented function
     *
     * @param Event $event
     * @param [type] $EventusersIds
     * @return void
     */
    public static function addEventUsersToEvent(Event $event, $eventusersIds)
    {

        $eventAttendees = [];

        //cargamos varios Attendee por UserId.

        $eventUsers = Attendee::find($eventusersIds);

        foreach ($eventUsers as $eventUser) {

            if ($eventUser->event_id == $event->id) {
                $eventAttendees[] = $eventUser;
            } else {
                $newEventUser = $eventUser->replicate();
                $newEventUser->event_id = $event->id;
                $newEventUser->stated_id = Attendee::STATE_DRAFT;
                $newEventUser->save();
                $eventAttendees[] = $newEventUser;
                echo " NuevoeventUser:>> " . $newEventUser->id . " <<";
            }
        }

        return $eventAttendees;

    }

    /**
     * Undocumented function
     *
     * @param Event $event
     * @param [type] $EventusersIds
     * @return void
     */
    public static function bookEventUsersToEvent(Event $event, $eventusersIds)
    {
        Log::debug("agregando");
        $eventAttendees = [];

        //cargamos varios Attendee por UserId.

        $eventUsers = Attendee::find($eventusersIds);

        foreach ($eventUsers as $eventUser) {
            Log::debug("eventUser: " . $eventUser->id);
            if ($eventUser->event_id == $event->id) {
                $newEventUser = $eventUser;
            } else {
                $newEventUser = $eventUser->replicate();
                $newEventUser->event_id = $event->id;
                echo " NuevoeventUser:>> " . $newEventUser->id . " <<";
            }

            $newEventUser->book()->save();
            $eventAttendees[] = $newEventUser;
        }

        return $eventAttendees;

    }

    /**
     * Add Users to an event in draft status
     *
     * @param Event       $event    Where users are going to be added
     * @param Array[Account] $usersIds Users to be added
     *
     * @return Attendee             eventUsers(attendees) added to the event
     */
    public static function addUsersToAnEvent(Event $event, $usersIds)
    {
        //cargamos varios Attendee por UserId.
        $eventUsers = Attendee::where('event_id', '=', $event->id)
            ->whereIn('account_id', $usersIds)
            ->get();

        $usersIdNotInEvent = self::getusersIdNotInEvent($eventUsers, $usersIds);

        foreach ($usersIdNotInEvent as $userId) {

            $user = Account::find($userId);
            if (!$user) {
                Log::debug('Account not found when trying to create. ' . $userId);
                continue;

            }
            Log::debug('Account not found when trying to create. ' . $userId);
            //Crear Attendee
            $eventUser = new Attendee;
            $eventUser->event_id = $event->id;
            $eventUser->account_id = $userId;
            $eventUser->properties = ["email" => $user->email, "name" => $user->name];

            $rol = Rol::where('level', 0)->first();
            $eventUser->rol_id = $rol->_id;
            $eventUser->rol_id = "60e8a7e74f9fb74ccd00dc22";

            $temp = State::first();
            $eventUser->state_id = $temp->_id;

            $eventUser->save();
            $eventUsers[] = $eventUser;
        }
        return $eventUsers;
    }

    private static function getusersIdNotInEvent($eventUsers, $usersIds)
    {
        $usersIdNotInEvent = array_filter($usersIds, function ($userId) use ($eventUsers) {
            $userIsInEvent = false;

            if (!$eventUsers || !count($eventUsers)) {
                return !$userIsInEvent;
            }

            foreach ($eventUsers as $eventUser) {
                if (isset($eventUser->account_id) && $eventUser->account_id == $userId) {
                    $userIsInEvent = true;
                }
            };
            return !$userIsInEvent;
        });

        return $usersIdNotInEvent;
    }

    /**
     * Store
     *
     * | Body Params   |
     * | ------------- |
     * | @body $_POST[role_id] required field       |
     * | @body $_POST[event_id]  required field     |
     * | @body $_POST[model_id] required field      |
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Contributors Resources
     */
    public static function saveRolUser($request)
    {
        return $request;
        $rol = $request;

        //find or create user
        if (!isset($rol['model_id'])) {
            if (isset($rol['properties'])) {
                $email = $rol['properties']['email'];
                $matchAttributes = ['email' => $email];
                $user = Account::updateOrCreate($matchAttributes, $rol['properties']);
                $rol['model_id'] = $user->id;
            } else {
                throw new Exception("model_id and properties are mandatory", 1);
            }
        }

        //add the user as contributor to the event with the specific rol
        $rol['model_type'] = "App\Account";
        $matchAttributesRol = [
            "role_id" => $rol['role_id'],
            "model_id" => $rol['model_id'],
            "event_id" => $rol["event_id"],
        ];
        $model = ModelHasRole::updateOrCreate($matchAttributesRol, $rol);
        $response = new ModelHasRoleResource($model);
        return $response;
    }

    public static function addDocumentUserToEventUserByEvent($event, $eventUser, $limit)
    {
        
        // asignar documents user a event user en properties
        $properties = $eventUser['properties'];
        

        if(isset($eventUser['properties']['documents_user']))
        {   
            $newDocument = DocumentUser::create([
                "name" => $event->name,
                "url" => $eventUser['properties']['documents_user'],
                "event_id" => $event->_id,
                "assign" => true
            ]);
            $newDocument->save();
            $properties_merge = array_merge($properties, ['documents_user' => ["url" => $newDocument->url, "name" => $newDocument->name]]);
            $eventUser['properties'] = $properties_merge;
            $eventUser->save();
        }else{
            // traer document user sin asignar
            $get_documets_user = DocumentUser::where('assign', false)->where('event_id', $event->_id)->paginate($limit);

            $documents_user = [];
            // asignar datos del event user a cada doc
            foreach ($get_documets_user as $doc) {
                $doc['eventuser_id'] = $eventUser['_id'];
                $doc['assign'] = true; // necesario cambiar de estado
                $doc->save();
                array_push($documents_user, $doc);
            }

            // asignar documents user a event user en properties
            $properties = $eventUser['properties'];
            $documents_user_url = [];
            foreach ($documents_user as $doc) {

                array_push($documents_user_url, ["name" => $doc['name'] , "url" =>  $doc['url']]);
            }
            $properties_merge = array_merge($properties, ['documents_user' => $documents_user_url]);
            $eventUser['properties'] = $properties_merge;
            $eventUser->save();

        }

        return $eventUser;
    }

    public static function asignRolToEventUser($rol_name, $event, $user)
    {
	// If the attendee is the owner of this event, don't change admin rol
	if($event->author_id === $user->_id)
	{
	  return '5c1a59b2f33bd40bb67f2322';
	}

        if ($rol_name) {
            $rol = Rol::where('name', $rol_name)->first();
            //dd("rol", $rol);
            // if ($rol == 'Administrator') {
            //     AdministratorService::notificationAdmin($rol, $data['properties']['email'], $event, $data['properties']['names']);
            // }
            $rol_id = $rol['_id'];
        } else {
            // asignar rol de asistente por defecto
            $rol_id = '60e8a7e74f9fb74ccd00dc22';
        }

        return $rol_id;
    }

    public static function generateBingoCardForAttendee($event_id, $event_user_id)
    {
      $bingo = Bingo::where('event_id', $event_id)->first();

      $bingoValues = $bingo->bingo_values;

      // Solo asignar cartones de bingo cuando el bingo tenga la cantidad de valores
      // minima para poder jugar segun las dimensiones correspondientes
      if(count($bingoValues) < $bingo->dimensions['minimun_values']) {
	  return ['message' => 'Not enough values to generate bingo cards'];
      }

      $randomBingoCardValues = [];
      // asignacion de valores al carton segun las dimensiones del bingo
      while(count($randomBingoCardValues) < $bingo->dimensions['amount']) {
        $randomValue = $bingoValues[rand(0, count($bingoValues) -1)];
        !in_array($randomValue, $randomBingoCardValues, true)
            && array_push($randomBingoCardValues, $randomValue);
      }

        //generar ramdom code para el carton - alfanumerico de 5 caracteres
        $randomCode = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        //verificar que el codigo no se repita
        $bingoCard = BingoCard::where('code', $randomCode)->first();
        if($bingoCard) {
            $randomCode = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        }

        $bingoCard = BingoCard::create(
            [
                'event_user_id' => $event_user_id,
                'event_id' => $event_id,
                'bingo_id' => $bingo->_id,
                'values_bingo_card' => $randomBingoCardValues,
                'code' => $randomCode
            ]
        );

      return $bingoCard;
    }

    /**
     * Cuando las dimensiones del bingo son cambiadas
     * y ya existen usuario con cartones asignados
     * se debe crear/modificar nuevos cartones
     * con estas nuevas especificaciones
     */
    public static function resetBingoCardsForAttendees($bingo)
    {
	$eventUsers = Attendee::where('event_id', $bingo->event_id)->get();

	foreach($eventUsers as $eventUser) {
	    // Eliminar carton
	    $bingoCard = BingoCard::where('event_user_id', $eventUser->_id)->first();
	    isset($bingoCard) && $bingoCard->delete();
	    // crear carton nuevo
	    self::generateBingoCardForAttendee($eventUser->event_id, $eventUser->_id);
	}
    }

    // Cuando un valor de un bingo es actualizado
    // en los cartones de los usuarios este valor debe actualizarce
    public static function updateBingoValues($bingo, $value)
    {
	// traer todos los bingo cards
	$bingoCards = BingoCard::where('bingo_id', $bingo->_id)->get();
	// verificar que existan cartones
	if(!isset($bingoCards)) {
	    return ['message' => 'There are no bingo cards to update'];
	}

        $updatedBingoValues = [];
	foreach($bingoCards as $bingoCard) {
	    // filtrar todos los que tengan ese valor
	    foreach($bingoCard->values_bingo_card as $bingoValue) {
		// remplazar el valor actualizar
                if($bingoValue['id'] === $value['id']) {
		    $bingoValue = $value;
                }
                array_push($updatedBingoValues, $bingoValue);
	    }

	    $bingoCard->values_bingo_card = $updatedBingoValues;
	    $bingoCard->save();
	    $updatedBingoValues = [];
	}
    }

    /**
     * Asignar campo para checkin de actividad
     *
     * Cuando un usuario es creado o importado desde
     * la seccion de checkin por actividad del cms, se debe
     * crear estructura donde detalla cual es el ingreso del asistente
     * a las actividades
     */
    public static function assignFieldForCheckinByActivity($eventUser, $activity_id)
    {
      $activityProperties = $eventUser->activityProperties ? $eventUser->activityProperties : [];

      if(count($activityProperties) > 0) {
	$activityAlreadyExists = array_filter($activityProperties, function($checkin) use ($activity_id) {
      	  return $checkin['activity_id'] === $activity_id;
      	});
	// En caso de volver a ser importado en la actividad no se recrea
	// el objecto con los datos
      	if ($activityAlreadyExists) {
      	  return $eventUser;
      	}
      }

      array_push($activityProperties, [
	'activity_id' => $activity_id,
	'checked_in' => false,
	'checked_at' => null,
	'checkedin_type' => null
      ]);
      $eventUser->activityProperties = $activityProperties;
      $eventUser->save();

      return $eventUser;
    }
}
