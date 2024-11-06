<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use App\Account;
use App\Payment;
use App\Billing;
use App\Plan;
use Log;
use DateTime;

class AutomaticPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automaticPayment:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command ejecute automatic payment';

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
        $users_has_payment = Payment::where('status', '=', 'AVAILABLE')
        ->latest()
        ->paginate(10);
        Log::debug("metodos de pago disponibles: " . count($users_has_payment));
        if (isset($users_has_payment)) {
            $users_payment = $users_has_payment->unique('user_id');
            $client = new Client([
                'base_uri' => 'https://sandbox.wompi.co/v1/'
            ]);
            $headers = [
                'accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer prv_test_zEMOm6RL3zlnhRzDP52w9PNN0zefS65d'
            ];
            $options['headers'] = $headers;
            //Get value of dolar
            $api_dolar = $client->getAsync('https://api.fastforex.io/fetch-one?from=USD&to=COP&api_key=demo')
                ->then(
                    function(ResponseInterface $res){
                        $response = json_decode($res->getBody()->getContents());
                        return $response;
                    },
                    function(RequestException $e){
                        $response['data'] = $e->getMessage();
                        return $response;
                    }
                );
            $response_dolar = $api_dolar->wait();
            $dolar_today = isset($response_dolar->result->COP) ? $response_dolar->result->COP : 4000;
            Log::debug("Valor del dolar: " . $dolar_today);
            //$dolar_today = 4000;
            
            //get the acceptance token || require public_key
            $response = $client->getAsync('merchants/pub_test_UGgvjUcTWcZv0Q57IhQrI4XcNObpSQe4')
                ->then(
                    function(ResponseInterface $res){
                        $response = json_decode($res->getBody()->getContents());
                        return $response;
                    },
                    function(RequestException $e){
                        $response['data'] = $e->getMessage();
                        return $response;
                    }
                );
            $response_token = $response->wait(); 
            $token = isset($response_token->data) ? $response_token->data->presigned_acceptance->acceptance_token : null;
            Log::debug("Acceptance token: ". $token);
            
            foreach ($users_payment as $user) {
                //get last renew billing
                $billing_renew = Billing::where('payment_id', $user->_id)
                ->where('action', 'RENEWAL')
                ->where('status', 'APPROVED')
                ->first();
                //get last sucription billing if renewal not exist
                $billing = $billing_renew == null ? Billing::where('payment_id', $user->_id)
                    ->where('action', 'SUBSCRIPTION')
                    ->first() : $billing_renew;
                
                if ($billing) {
                    Log::debug("Billing para validar fecha: " . $billing->_id);
                    $end_date = DateTime::createFromFormat('U', strtotime($billing->billing['end_date']));
                    $today = new DateTime();
                    //Log::info("CHECK AUTOMATIC PAYMENT");
                    //Log::info($today);
                
                    // if the end date is equal to the actual date the automatic payment is generated
                    //change condition to test
                    Log::debug("Fecha actual: " . $today->format('Y-m-d H:i:s'));
                    Log::debug("Fecha de corte: " . $end_date->format('Y-m-d H:i:s'));
                    if ($today >= $end_date) {
                        Log::debug("Cumple requisito para pago automatico");
                        $reference_evius =  'RENEWAL-' . $today->format('Y-m-d') .'-'. random_int(0001,10000);
                        $plan = Plan::find($billing->plan_id);
                        $base = $plan->price;
                        $total = $base + ($base * $billing->billing['tax']);
                        $cents = round(($total * $dolar_today * 100));
                    
                        //build body to wompi
                        $options['body'] = $this::createBodyWompi($token, $cents, $user, $reference_evius, $user->type);
                    
                        //POST CREATE TRANSACTION
                        $promise = $client->postAsync('transactions', $options)
                            ->then(
                                function(ResponseInterface $res){
                                    $response = json_decode($res->getBody()->getContents());
                                    return $response;
                                },
                                function(RequestException $e){
                                    $response['data'] = $e->getMessage();
                                    return $response;
                                }
                            );
                        $response = $promise->wait();
                        
                        if (!isset($response->data)) {
                            return response()->json(['message' => $response['data']], 401);
                        }
                        $isPending = true;
                        while ($isPending) {
                            $get_transaction = $client->getAsync('transactions/' . $response->data->id)
                                ->then(
                                    function(ResponseInterface $res){
                                        $response = json_decode($res->getBody()->getContents());
                                        return $response;
                                    },
                                    function(RequestException $e){
                                        $response['data'] = $e->getMessage();
                                        return $response;
                                    }
                                );
                            $response = $get_transaction->wait();
                            $status = isset($response->data->status) ? $response->data->status : "PENDING";
                            if ($status != "PENDING") {
                                $isPending = false;
                            }
                        }
                    
                        //CREATE NEW BILLING
                        $save_billing = $this::createNewBilling($user, $billing, $response, $reference_evius, $base, $total, $status);
                        //Log::info($save_billing);
                    }
                    Log::debug("No Cumple requisito para pago automatico");
                
                }
            }
        }
    }


    public function createBodyWompi($token, $cents, $user, $reference_evius, $method_type)
    {   
        switch ($method_type) {
            case 'CARD':
                //build body
                $body['amount_in_cents'] = $cents;
                $body['currency'] = 'COP';
                $body['customer_email'] = $user->address['email'];
                $body['payment_method']['installments'] = 1;
                $body['reference'] = $reference_evius;
                $body['payment_source_id'] = $user->id;
            case 'NEQUI':
                //build body
                $body['amount_in_cents'] = $cents;
                $body['currency'] = 'COP';
                $body['customer_email'] = $user->address['email'];
                $body['reference'] = $reference_evius;
                $body['payment_source_id'] = $user->id;
                break;
            default:
                break;
        }
        //dd("body", $body);
        $body = json_encode($body);

        return $body;
    }

    public function createNewBilling($user, $billing, $response, $reference_evius, $base, $total, $status)
    {
        //CREATE NEW BILLING
        $newBilling['user_id'] = $user->user_id;
        $newBilling['plan_id'] = $billing->plan_id;
        $newBilling['billing']['save'] = true;
        $newBilling['billing']['reference_wompi'] = $response->data->id;
        $newBilling['billing']['reference_evius'] = $reference_evius;
        //new startdate
        $start_date = date('d-m-Y');
        $newBilling['billing']['start_date'] = $start_date;
        //new end date
        $end_date = date('d-m-Y', strtotime($start_date . "+ 30 days"));
        $newBilling['billing']['end_date'] = $status == 'APPROVED' ? $end_date : $start_date;
        $newBilling['billing']['base_value'] = $base;
        $newBilling['billing']['tax'] = $billing->billing['tax'];
        $newBilling['billing']['total'] = $total;
        $newBilling['billing']['details']['plan']['price'] = $base;
        $newBilling['billing']['details']['plan']['amount'] = 1;
        $newBilling['billing']['subscription_type'] = 'MONTHLY';
        $newBilling['billing']['currency'] = 'USD';
        $newBilling['action'] = 'RENEWAL';
        $newBilling['status'] = $status;
        $newBilling['payment_id'] = $user->_id;

        $save_billing = app('App\Http\Controllers\BillingController')
            ->saveAutomaticPayment($newBilling);
        return $save_billing;
    }
}
