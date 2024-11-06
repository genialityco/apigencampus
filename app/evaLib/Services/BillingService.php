<?php

namespace App\evaLib\Services;

use Mail;
//Models
use App\Plan;
use App\Payment;
// Google cloud
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

/**
 * Undocumented class
 */
class BillingService
{
    public static function generatePurchaseConsolidation($billing)
    {
      // Generate client for Google Sheets
      $client = new Client();
      $client->setApplicationName('Facturacion Evius');
      $client->setScopes(Sheets::SPREADSHEETS);
      $client->setAuthConfig('credentials.json');
      $client->setAccessType('offline');

      // write in excel for accounting team
      $service = new Sheets($client);
      $documentId = '1W3wumByrcdyTddenaba7WfkM9un28Zook0QSrcH5Do0';
      $range = 'A:Z';

      // get clien data(payment_method), if it does not exist in the billing, it can be searched in the payment
      if( empty($billing['billing']['payment_method'])) {
	$clientData = Payment::findOrFail($billing['payment_id']);
      } else {
	$clientData = $billing['billing']['payment_method'];
      }

      $dollarToday = $billing['billing']['dollarToday'];
      // purchase details
      $getDetails = $billing['billing']['details'];
      if(isset( $getDetails['plan'] )) {
	$plan = Plan::findOrFail($billing['plan_id']);
	$pricePesos = intval( $getDetails['plan']['price'] * $dollarToday );
	$planDetails = "Plan: $plan->name, Precio Pesos: \$$pricePesos, Precio Dólares: \${$getDetails['plan']['price']}";
      }
      if(isset( $getDetails['users'] ) && $getDetails['users']['amount'] !=0) {
	$pricePesos = intval( ($getDetails['users']['price'] * $dollarToday) * $getDetails['users']['amount'] );
	$priceDollars = $getDetails['users']['price'] * $getDetails['users']['amount'];
	$usersDetails = "Usuarios: {$getDetails['users']['amount']}, Precio Pesos: \$$pricePesos, Precio Dólares: \$$priceDollars";
      }
      // define details
      if(isset($planDetails) && isset($usersDetails)) {
	$details = "$planDetails\n$usersDetails";
      } elseif (isset($planDetails)) { 
	$details = "$planDetails";
      } else {
	$details = "$usersDetails";
      }


      $values = [
	[
	    $billing['billing']['start_date'], // Fecha de la venta
	    $names = isset($clientData['address']['last_name']) ?
	      "{$clientData['address']['name']} {$clientData['address']['last_name']}"
	      : $clientData['address']['name'], // Nombre y apellidos
	    $clientData['address']['identification']['value'], // Identificación
	    $clientData['address']['identification']['type'], // Tipo de identificación
	    "+{$clientData['address']['prefix']} {$clientData['address']['phone_number']}", // Teléfono
	    $clientData['address']['billing_email'], // E-mail
	    $clientData['address']['country'], // Pais
	    $city = isset( $clientData['address']['city'] ) ?
	      $clientData['address']['city']
	      : "No aplica", // Ciudad
	    $clientData['address']['address_line_1'], // Dirección
	    $billing['billing']['total'] / 100, // Concepto Pesos
	    $billing['billing']['totals']['usd'], // Concepto Dolares
	    $details, // Detalles compra 
	    $billing['billing']['base_value'] * $dollarToday, // Valor base de la venta Pesos
	    $billing['billing']['base_value'], // Valor base de la venta Dolares
	    $billing['billing']['tax'] * 100 . "%", // IVA de la venta 
	    $discount = isset($billing['billing']['total_discount']) ?
	      $billing['billing']['total_discount'] * $dollarToday : 0, // Descuentos en la venta Pesos
	    $discount = isset($billing['billing']['total_discount']) ?
	      $billing['billing']['total_discount'] : 0, // Descuentos en la venta Dolares
	    $clientData['method_name'], // Medio de pago 
	],
      ];

      $body = new ValueRange([
	'values' => $values
      ]);

      $params = [
	'valueInputOption' => 'RAW'
      ];

      //$doc = $service->spreadsheets_values->get($documentId,$range);
      //$doc = $service->spreadsheets_values->update($documentId,$range, $body, $params);
      $doc = $service->spreadsheets_values->append($documentId,$range, $body, $params);

      return $doc;
    }
}
