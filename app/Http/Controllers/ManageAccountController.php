<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountPaymentGateway;
use App\Models\Currency;
use App\Models\PaymentGateway;
use App\Models\Ticket;
use App\Models\Timezone;
use App\Models\User;
use App\Event;
use Auth;
use Hash;
use HttpClient;
use Illuminate\Http\Request;
use Input;
use Mail;
use Validator;
use GuzzleHttp\Client;

class ManageAccountController extends MyBaseController
{
    /**
     * Show the account modal
     *
     * @param Request $request
     * @return mixed
     */
    public function showEditTickets(Request $request)
    {
        $event = Event::find($request->event_id);
        $tickets = Ticket::where('event_id', $request->event_id)->where('is_hidden', 0)->get();
        $codes_discount = isset($event->codes_discount) ? $event->codes_discount : [];
        $stage_event = $event->event_stages ? $event->event_stages : [];
        $ticket_discount = isset($event->tickets_discount) ? $event->tickets_discount : '';
        $percentage_discount = isset($event->percentage_discount) ? $event->percentage_discount : '';
        $seats_configuration = isset($event->seats_configuration) ? $event->seats_configuration: '';
        $tickets_amount = isset($event->tickets_amount) ? $event->tickets_amount : '';

        $data = [
            'account'                  => Auth::user(),
            'timezones'                => Timezone::pluck('location', 'id'),
            'currencies'               => Currency::pluck('title', 'id'),
            'payment_gateways'         => PaymentGateway::pluck('provider_name', 'id'),
            'account_payment_gateways' => AccountPaymentGateway::scope()->get(),
            'version_info'             => $this->getVersionInfo(),
            'event_id'                 => $request->event_id,
            'codes_discount'           => $codes_discount,
            'ticket_discount'          => $ticket_discount,
            'tickets_amount'           => $tickets_amount, 
            'percentage_discount'      => $percentage_discount,
            'seats_configuration'      => $seats_configuration,
            'tickets'                  => $tickets,
            'stages'                   => $stage_event 
            
        ];

        return view('ManageAccount.Modals.EditAccount', $data);
    }


    public function showStripeReturn()
    {
        $error_message = trans("Controllers.stripe_error");

        if (Input::get('error') || !Input::get('code')) {
            \Session::flash('message', $error_message);

            return redirect()->route('showEventsDashboard');
        }

        $request = [
            'url'    => 'https://connect.stripe.com/oauth/token',
            'params' => [

                'client_secret' => STRIPE_SECRET_KEY,
                'code'          => Input::get('code'),
                'grant_type'    => 'authorization_code',
            ],
        ];

        $response = HttpClient::post($request);

        $content = $response->json();

        if (isset($content->error) || !isset($content->access_token)) {
            \Session::flash('message', $error_message);

            return redirect()->route('showEventsDashboard');
        }

        $account = Account::find(\Auth::user()->account_id);

        $account->stripe_access_token = $content->access_token;
        $account->stripe_refresh_token = $content->refresh_token;
        $account->stripe_publishable_key = $content->stripe_publishable_key;
        $account->stripe_data_raw = json_encode($content);

        $account->save();

        \Session::flash('message', trans("Controllers.stripe_success"));

        return redirect()->route('showEventsDashboard');
    }


    /**
     * Edit an account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditAccount()
    {
        $account = Auth::user();

        if (!$account->validate(Input::all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $account->errors(),
            ]);
        }

        $account->first_name = Input::get('first_name');
        $account->last_name = Input::get('last_name');
        $account->email = Input::get('email');
        $account->timezone_id = Input::get('timezone_id');
        $account->currency_id = Input::get('currency_id');
        $account->save();

        return response()->json([
            'status'  => 'success',
            'id'      => $account->id,
            'message' => trans("Controllers.account_successfully_updated"),
        ]);
    }

    /**
     * Save account payment information
     *
     * @param Request $request
     * @return mixed
     */
    public function postEditAccountPayment(Request $request)
    {
        $account = Auth::user();
        $gateway_id = $request->get('payment_gateway_id');

        switch ($gateway_id) {
            case config('attendize.payment_gateway_stripe') : //Stripe
                $config = $request->get('stripe');
                break;
            case config('attendize.payment_gateway_paypal') : //PayPal
                $config = $request->get('paypal');
                break;
            case config('attendize.payment_gateway_placetopay') : //MIGS
				$config = $request->get('placetopay');
				break;
            case config('attendize.payment_gateway_payu') : //PAYU
                $config = $request->get('payu');
                break;
            case config('attendize.payment_gateway_coinbase') : //BitPay
                $config = $request->get('coinbase');
                break;
			case config('attendize.payment_gateway_migs') : //MIGS
				$config = $request->get('migs');
				break;
        }

        $account_payment_gateway = AccountPaymentGateway::firstOrNew(
            [
                'payment_gateway_id' => $gateway_id,
                'account_id'         => $account->id,
            ]);
        $account_payment_gateway->config = $config;
        $account_payment_gateway->account_id = $account->id;
        $account_payment_gateway->payment_gateway_id = $gateway_id;
        $account_payment_gateway->save();

        $account->payment_gateway_id = $gateway_id;
        $account->save();

        return response()->json([
            'status'  => 'success',
            'id'      => $account_payment_gateway->id,
            'message' => trans("Controllers.payment_information_successfully_updated"),
        ]);
    }

    /**
     * Invite a user to the application
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postInviteUser()
    {
        $rules = [
            'email' => ['required', 'email', 'unique:users,email,NULL,id,account_id,' . Auth::user()->account_id],
        ];

        $messages = [
            'email.email'    => trans("Controllers.error.email.email"),
            'email.required' => trans("Controllers.error.email.required"),
            'email.unique'   => trans("Controllers.error.email.unique"),
        ];

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status'   => 'error',
                'messages' => $validation->messages()->toArray(),
            ]);
        }

        $temp_password = str_random(8);

        $user = new User();

        $user->email = Input::get('email');
        $user->password = Hash::make($temp_password);
        $user->account_id = Auth::user()->account_id;

        $user->save();

        $data = [
            'user'          => $user,
            'temp_password' => $temp_password,
            'inviter'       => Auth::user(),
        ];

        Mail::send('Emails.inviteUser', $data, function ($message) use ($data) {
            $message->to($data['user']->email)
                ->subject(trans("Email.invite_user", ["name"=>$data['inviter']->first_name . ' ' . $data['inviter']->last_name, "app"=>config('attendize.app_name')]));
        });

        return response()->json([
            'status'  => 'success',
            'message' => trans("Controllers.success_name_has_received_instruction", ["name"=>$user->email]),
        ]);
    }

    public function getVersionInfo()
    {
        $installedVersion = null;
        $latestVersion = null;

        try {
            $http_client = new Client();

            $response = $http_client->get('https://attendize.com/version.php');
            $latestVersion = (string)$response->getBody();
            $installedVersion = file_get_contents(base_path('VERSION'));
        } catch (\Exception $exception) {
            return false;
        }

        if ($installedVersion && $latestVersion) {
            return [
                'latest'      => $latestVersion,
                'installed'   => $installedVersion,
                'is_outdated' => (version_compare($installedVersion, $latestVersion) === -1) ? true : false,
            ];
        }

        return false;
    }


    /**
     * Edit an account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditCodesPromocional()
    {
        $percentage_discount = Input::get('percentage_discount');
        $tickets_availability = Input::get('tickets_availability');
        $codes_title = Input::get('codes_title');
        $event_id = Input::get('event_id');
        $ticket_to_discount = Input::get('ticket_to_discount');
        $tickets_amount = Input::get('tickets_amount');

        $event = Event::find($event_id);
        if (isset($event->codes_discount)) { 
            foreach ($event->codes_discount as $code) {
                if ($code['id'] == $codes_title) {
                    $message_error = 'Ticket name has already been used';
                    return response()->json(
                        [
                        'status'  => 'error',
                        'message' => $message_error,
                        ]   
                    );
                    break;

                } 
            }
        }
            //Generador de códigos
            $codes = isset($event->codes_discount) ? $event->codes_discount : [];
            /* Funcion Generar códigos Aleatorios */
            // for ($j=0; $j < $codes_discount; $j++) { 
            //     $key = '';
            //     $longitud = 8;
            //     $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
            //     $max = strlen($pattern)-1;
            //     for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            // }
            $code = [
                'id' => $codes_title,
                'percentage' => $percentage_discount,
                'available' => true,
                'quantity'  => $tickets_availability,
                'ticket_assigned'  => $ticket_to_discount,
                'tickets_amount'=>$tickets_amount
            ];
            array_push($codes, $code);
            $event->codes_discount = $codes;
            $event->save();

            return response()->json([
                'status'  => 'success',
                'data'    => $event->codes_discount,
                'message' => trans("Controllers.account_successfully_updated"),
            ]);
    }

       /**
     * Edit an account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditTicketsPromocional()
    {

        $percentage_discount = Input::get('percentage_discount');
        $tickets_discount = Input::get('tickets_discount');
        $event_id = Input::get('event_id');
        $event = Event::find($event_id);
        $event->tickets_discount = $tickets_discount;
        $event->percentage_discount = $percentage_discount;
        $event->save();

        return response()->json([
            'status'  => 'success',
            'id'      => $event->id,
            'message' => trans("Controllers.account_successfully_updated"),
        ]);
    }

    /**
     * Edit seats configuration
     *
     * @return void
     */
    public function postEditSeats()
    {

        $event_id = Input::get('event_id');
        $event = Event::find($event_id);
        $seats_configuration = [];
        $seats_configuration['keys']['secret'] = Input::get('key_secret');
        $seats_configuration['keys']['public'] = Input::get('key_public');
        $seats_configuration['keys']['designer'] = Input::get('key_designer');
        $seats_configuration['keys']['event'] = Input::get('key_event');
        $seats_configuration['language'] = Input::get('language') ? 'es':'en';
        $seats_configuration['status'] = Input::get('status')? true : false;
        $seats_configuration['minimap'] = Input::get('minimap')? true : false;

        $event->seats_configuration = $seats_configuration;
        $event->save();

        return response()->json([
            'status'  => 'success',
            'message' => trans("Controllers.account_successfully_updated"),
        ]);

        $percentage_discount = Input::get('percentage_discount');
        $tickets_discount = Input::get('tickets_discount');
        $event_id = Input::get('event_id');
        $event = Event::find($event_id);
        $event->tickets_discount = $tickets_discount;
        $event->percentage_discount = $percentage_discount;
        $event->save();

        return response()->json([
            'status'  => 'success',
            'id'      => $event->id,
            'message' => trans("Controllers.account_successfully_updated"),
        ]);
    }

    /**
     * Edit Advanced Configuration
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditAdvancedConfiguration()
    {
        $event_id = Input::get('event_id');
        $event = Event::find($event_id);
        $event->allow_company = Input::get('allow_company')? true : false;
        $event->save();

        return response()->json([
            'status'  => 'success',
            'id'      => $event->id,
            'message' => trans("Controllers.account_successfully_updated"),
        ]);
    }
    
}
