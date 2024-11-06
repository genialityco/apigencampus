<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\EventCheckoutController;
use Log;
use App\Order;

class PetitionPlaceToPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Petition:PlaceToPay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command get status purshase pending in placetopay every minute';

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
        Log::info('new cron');
        $pending_code = "5c4a299c5c93dc0eb199214a";
        $orders = Order::select('order_reference')->where('order_status_id',$pending_code)->get();
        foreach($orders as $order){
            $EventCheckoutController = app()->make('App\Http\Controllers\EventCheckoutController');
            $response = app()->call([$EventCheckoutController, 'showOrderPaymentStatusDetails'], ['order_reference' => $order->order_reference, 'cron' => true]);
            Log::info($response);
        }
    }
}
