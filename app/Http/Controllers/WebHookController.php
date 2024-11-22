<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Cache;

// Models
use App\BurnedTicket;
use App\Billing;

use Log;
use App\Organization;
use App\OrganizationUser;
use Carbon\Carbon;

class WebHookController extends Controller
{
    private function generateCode()
    {
        $randomCode = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        //verificar que el codigo no se repita
        $burnedTicket = BurnedTicket::where('code', $randomCode)->first();
        if(!empty( $burnedTicket )) {
	    $this->generateCode();
        }

	return $randomCode;
    }

    private function validateStatus($transaction)
    {
	$status = $transaction['status'];

	return $status === "APPROVED" ? true : false;
    }

    private function createBurnedTicket($transaction, $params, $billing)
    {
	$ticketData = [
	    'billing_id' => $billing->_id,
	    'user_id' => $params['user_id'],
	    'code' => $this->generateCode(),
	    'state' => 'ACTIVE',
	    'event_id' => $params['event_id'],
	    'ticket_category_id' => $params['category_id'],
	    'price_usd' => intval($params['price']),
	    'amount_in_cents' => $transaction['amount_in_cents'],
	    'assigned_to' => [
		'name' => urldecode($params['assigned_to_name']),
		'email' => $params['assigned_to_email'],
		'document' => [
		    'type_doc' => $params['assigned_to_doc_type'],
		    'value' => $params['assigned_to_doc_number']
		]
	    ]
	];

	$burnedTicket = BurnedTicket::create($ticketData);

	// Enviar ticket
	// Si la persona que compra es la misma
	// que se le asignara el ticket solo se envia un correo
	$emails = $params['assigned_to_email'] != $transaction['customer_email'] ?
	    [$params['assigned_to_email'], $transaction['customer_email']] :
	    $params['assigned_to_email'];

	// Idioma en cual se enviara el correo
	$getLang = !empty( $params['lang'] ) ? $params['lang'] : 'en';

	$lang = in_array($getLang, ['es', 'en']) ? // Idiomas permitidos
	    $getLang : 'en'; // Si no es valido el Idioma entonces ingles por default

        Mail::to($emails)
            ->queue(
                new \App\Mail\BurnedTicketMail($burnedTicket, $lang)
            );
    }

	public function mainHandler(Request $request)
	{
		// Obtener el contenido JSON de la solicitud de Wompi
		$eventData = $request->json()->all();
		Log::debug("create transaction of: " . json_encode($eventData));
	
		// Almacenar la información en el caché con una clave única y un tiempo de vida (en segundos)
		Cache::put('transaccion_' . $eventData['data']['transaction']['id'], $eventData, 60);
	
		// Verificar los datos de la transacción
		Log::debug("event type: " . $eventData['event']);
		if ($eventData['event'] == 'transaction.updated') {
			$transaction = $eventData['data']['transaction'];
	
			Log::debug("Received status of transaction: " . $transaction['status']);
			if ($transaction['status'] == 'APPROVED') {
				$amount_in_cents = $transaction['amount_in_cents'];
				$amount = floor($amount_in_cents / 100);
				Log::debug("paid: " . $amount);
	
				$reference = $transaction['reference'];
				Log::debug("reference: " . $reference);
	
				$parts = explode("-", $reference);
				$organization_id = $parts[1];
				$user_id = $parts[2];
	
				// Buscar la organización y el usuario de la organización
				$organization = Organization::findOrFail($organization_id);
				$organization_user = OrganizationUser::where("account_id", $user_id)->first();
	
				if (!$organization_user) {
					Log::error("Cannot find user with id: " . $user_id . ". Assignment of paid plan canceled.");
				} else {
					$days = 30; // Valor por defecto
	
					if (isset($organization['access_settings']) && isset($organization['access_settings']['days'])) {
						$days = $organization['access_settings']['days'];
					}
	
					$today = Carbon::now();
					$existing_plan = $organization_user->payment_plan; // Asume que hay una relación one-to-one
	
					if ($existing_plan) {
						// Actualizar el `date_until` si ya existe un plan
						$new_date_until = Carbon::parse($existing_plan->date_until)->addDays($days);
						$existing_plan->update([
							'date_until' => $new_date_until->toIso8601String(),
							'price' => $amount
						]);
	
						Log::debug("Updated payment plan for user id: " . $user_id . " : " . json_encode($existing_plan));
					} else {
						// Crear un nuevo plan si no existe
						$payment_plan = new \App\PaymentPlan([
							"days" => $days,
							"date_until" => $today->addDays($days)->toIso8601String(),
							"price" => $amount,
						]);
	
						$organization_user->payment_plan()->save($payment_plan);
						Log::debug("New payment plan for user id: " . $user_id . " : " . json_encode($payment_plan));
					}
	
					$organization_user->save();
				}
			}
		}
	
		return response()->json(['message' => 'Evento almacenado con éxito'], 200);
	}
	

    // Método para obtener el evento almacenado
    public function getStoredEvent($transactionId)
    {
        try{
            $transactionData = Cache::get('transaccion_' . $transactionId);

            if ($transactionData) {
                return response()->json($transactionData);
            } else {
                return response()->json(['message' => 'Transacción no encontrada'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener la transacción'], 500);
        }
    }

    /*public function mainHandler(Request $request)
    {
	$data = $request->json()->all();
	$transactionStatus = $this->validateStatus($data['data']['transaction']);

	if(!$transactionStatus) {
	    return response()->json(['message' => 'error'], 400);
	}

        // Para boleteria quemada
        $url = $data['data']['transaction']['redirect_url'];

	// Obtener la cadena de consulta de la URL
	$queryString = parse_url($url, PHP_URL_QUERY);

	// Obtener query params
	parse_str($queryString, $params);

	// Crear Billing asocido al usuario
	// Este user_id es sacado de user que tiene
	// cuenta iniciada en evius cuando hace el pago
	$data['user_id'] = $params['user_id'];
	$billing = Billing::create($data);

	$burned = !empty($params['burned']) ?
	    filter_var($params['burned'], FILTER_VALIDATE_BOOLEAN) : false;
	if($burned) {
	    $this->createBurnedTicket($data['data']['transaction'], $params, $billing);
	}

	return response()->json(['message' => 'ok']);
    }*/
}
